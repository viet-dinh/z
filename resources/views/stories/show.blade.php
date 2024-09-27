@extends('layouts.main')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])

    <div class="container py-8">
        <div class="row">
            <!-- Left side: Thumbnail -->
            <div class="col-lg-4">
                <img src="{{ $story->getThumnailUrl() }}" alt="Story Thumbnail" class="rounded shadow-lg img-fluid">
            </div>

            <!-- Right side: Story details -->
            <div class="col-lg-8">
                <h1 class="display-4 font-weight-bold mb-4">{{ $story->title }}</h1>

                <div class="d-flex align-items-center mb-4">
                    <div class="mr-4 text-warning">
                        <i class="fas fa-star"></i> {{ $story->rating }} / 5
                    </div>
                    <div class="mr-4 text-muted">
                        <i class="fas fa-eye"></i> {{ $story->views }} views
                    </div>
                    <div class="text-danger">
                        <i class="fas fa-heart"></i> {{ $story->likes }} likes
                    </div>
                </div>

                <p><strong>Author:</strong> {{ $story->author }}</p>
                <p><strong>Translator:</strong> {{ $story->translator ?? 'N/A' }}</p>
                <p><strong>Chapters:</strong> {{ $story->current_chapter }} out of {{ $story->total_chapters }}</p>
                <p><strong>Status:</strong>
                    @if ($story->status == 'complete')
                        <span class="text-success">Complete</span>
                    @else
                        <span class="text-warning">Incomplete</span>
                    @endif
                </p>
                <p><strong>Description:</strong> {{ $story->description }}</p>
            </div>
        </div>

        <!-- Chapters List -->
        <div class="mt-5">
            <h2 class="h3">Chapters</h2>
            @foreach ($story->chapters as $chapter)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('chapter.show', [$story->slug, $chapter->order]) }}"
                        class="font-weight-bold">{{ $chapter->title }}</a>
                    <span class="text-muted">{{ $chapter->created_at->format('M d, Y') }}</span>
                </div>
            @endforeach
        </div>

        <div id="root" story-id="{{ $story->id }}" auth-user-id="{{$authId}}"></div> 
        @vite(['resources/css/app.css'])
        @viteReactRefresh
        @vite('resources/js/app.jsx')

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $('#addCommentForm').on('submit', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    $.ajax({
                        url: $(this).attr('action'), // The action attribute of the form
                        type: 'POST',
                        data: $(this).serialize(), // Serialize form data
                        success: function(response) {
                            // Assuming the response contains the new comment data
                            $('#commentsList').prepend(`
                                <div class="card mb-4" data-comment-id="${response.id}">
                                    <div class="card-body">
                                        <p>${response.content}</p>
                                        <div class="d-flex gap-2">
                                            @foreach (App\Enums\ReactionType::cases() as $reaction)
                                                <div class="reaction" id="reactionCount-{{ $reaction->value }}-comment-${response.id}">
                                                    <button class="btn btn-outline-secondary btn-sm" onclick="addReaction(${response.id}, '{{ $reaction->value }}', 'comment')">
                                                        {{ $reaction->getEmoji() }} <span class="reaction-count">0</span>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-light btn-sm" onclick="toggleReactionBox(${response.id}, 'comment')">
                                                <i class="far fa-smile"></i> React
                                            </button>
                                            <button class="btn btn-link btn-sm" onclick="toggleReplyForm(${response.id})">Reply</button>
                                        </div>
                                        <div id="reactionBox-comment-${response.id}" class="mt-2 d-none"></div>
                                        <div class="ml-4 mt-3"></div>
                                    </div>
                                </div>
                            `);
                            // Reset the form
                            $('#addCommentForm')[0].reset();
                        },
                        error: function(xhr) {
                            alert('Error adding comment. Please try again.');
                        }
                    });
                });

                // Handle reply submission
                $(document).on('submit', '.replyForm', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    const $form = $(this);
                    $.ajax({
                        url: $form.attr('action'), // The action attribute of the reply form
                        type: 'POST',
                        data: $form.serialize(), // Serialize form data
                        success: function(response) {
                            const commentId = $form.closest('.card').data('comment-id');
                            const repliesContainer = $form.closest('.card').find('.ml-4.mt-3');

                            repliesContainer.append(`
                                <div class="card mb-2" data-reply-id="${response.id}">
                                    <div class="card-body">
                                        <p>${response.content}</p>
                                        <div class="d-flex gap-2">
                                            @foreach (App\Enums\ReactionType::cases() as $reaction)
                                                <div class="reaction" id=reactionCount-{{ $reaction->value }}}-reply-${response.id}">
                                                    <button class="btn btn-outline-secondary btn-sm" onclick="addReaction(${response.id}, '{{ $reaction->value }}', 'reply')">
                                                        {{ $reaction->getEmoji() }} <span class="reaction-count">0</span>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-light btn-sm" onclick="toggleReactionBox(${response.id}, 'reply')">
                                                <i class="far fa-smile"></i> React
                                            </button>
                                        </div>
                                        <div id="reactionBox-reply-${response.id}" class="mt-2 d-none"></div>
                                    </div>
                                </div>
                            `);

                            $form[0].reset();
                            $form.closest(`#replyForm-${commentId}`).addClass(
                                'd-none'); // Hide the reply form after submission
                        },
                        error: function(xhr) {
                            alert('Error adding reply. Please try again.');
                        }
                    });

                });

                // Handle adding reactions
                window.addReaction = function(id, reactionType, reactableType) {
                    $.ajax({
                        url: `api/v1/reactions/${reactableType}/${id}`, // Your route for adding reactions
                        type: 'POST',
                        data: {
                            type: reactionType,
                            _token: '{{ csrf_token() }}' // Include CSRF token
                        },
                        success: function(response) {
                            if (response) {
                                // Increment the reaction count
                                // Update the reaction count in the UI
                                const countElement = document.getElementById(
                                    `reactionCount-${reactionType}-${reactableType}-${id}`);
                                const currentCount = parseInt(countElement.textContent) || 0;

                                if (currentCount == 0) {
                                    countElement.closest('div').classList.remove('d-none');
                                }
                                countElement.textContent = currentCount + 1; // Increase count by 1
                            } else {
                                const countElement = document.getElementById(
                                    `reactionCount-${reactionType}-${reactableType}-${id}`);

                                const currentCount = parseInt(countElement.textContent) || 0;

                                if (currentCount == 1) {
                                    countElement.closest('div').classList.add('d-none');
                                }

                                countElement.textContent = currentCount - 1; // Increase count by 1
                            }

                        },
                        error: function(xhr) {
                            alert('Error adding reaction. Please try again.');
                        }
                    });
                };

                // Show/hide reply form
                window.toggleReplyForm = function(commentId) {
                    const replyForm = $(`#replyForm-${commentId}`);
                    replyForm.toggleClass('d-none'); // Toggle the visibility of the reply form
                };

                // Show/hide reaction box
                window.toggleReactionBox = function(id, type) {
                    const reactionBox = $(`#reactionBox-${type}-${id}`);
                    reactionBox.toggleClass('d-none'); // Toggle the visibility of the reaction box
                };
            });
        </script>
    @endsection
