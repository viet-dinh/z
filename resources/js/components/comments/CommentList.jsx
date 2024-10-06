import React, { useState, useEffect, useRef, useCallback } from "react";
import Comment from "./Comment";
import { QuestionProvider } from "./CommentProvider";
import api from "../../api";
import IconTextField from "./IconTextField";
import { useApp } from "../../AppProvider";

const CommentList = () => {
    const { storyId, chapterOrder } = useApp();
    const [comments, setComments] = useState([]);
    const [newComment, setNewComment] = useState("");
    const [page, setPage] = useState(1);
    const [hasMore, setHasMore] = useState(true);
    const [loading, setLoading] = useState(false);
    const observer = useRef();

    useEffect(() => {
        loadComments(page);
    }, [page]);

    const loadComments = (pageNumber) => {
        setLoading(true);
        api.get(`/stories/${storyId}/comments?page=${pageNumber}`)
            .then((response) => {
                const newComments = response.data.data;
                setComments((prevComments) => [
                    ...prevComments,
                    ...newComments,
                ]);
                setHasMore(
                    response.data.meta.current_page <
                        response.data.meta.last_page
                );
                setLoading(false);
            })
            .catch((error) => {
                console.error("Error fetching comments:", error);
                setLoading(false);
            });
    };

    const handleSubmitComment = () => {
        api.post(`/stories/${storyId}/comments`, {
            content: newComment,
            chapter_order: chapterOrder ?? undefined,
        })
            .then((response) => {
                setComments([response.data.data, ...comments]);
                setNewComment("");
            })
            .catch((error) =>
                console.error("Error submitting comment:", error)
            );
    };

    const handleDeleteComment = (commentId) => {
        setComments(comments.filter((comment) => comment.id !== commentId));
    };

    const lastCommentRef = useCallback(
        (node) => {
            if (observer.current) observer.current.disconnect();
            observer.current = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting && hasMore && !loading) {
                    setPage((prevPage) => prevPage + 1);
                }
            });
            if (node) observer.current.observe(node);
        },
        [hasMore, loading]
    );

    return (
        <div className="mt-4">
            <h2 className="text-xl font-semibold mb-4">Bình luận</h2>

            <form className="space-y-4">
                <div className="form-group">
                    <IconTextField
                        value={newComment}
                        onChange={(e) => setNewComment(e.target.value)}
                        onSubmit={() => handleSubmitComment()}
                        placeholder={"Viêt bình luận"}
                    />
                </div>
            </form>

            <div className="mt-5 space-y-4">
                {comments.map((comment, index) => {
                    if (comments.length === index + 1) {
                        return (
                            <div ref={lastCommentRef} key={comment.id}>
                                <QuestionProvider>
                                    <Comment
                                        comment={comment}
                                        onDelete={handleDeleteComment}
                                    />
                                </QuestionProvider>
                            </div>
                        );
                    } else {
                        return (
                            <QuestionProvider key={comment.id}>
                                <Comment
                                    comment={comment}
                                    onDelete={handleDeleteComment}
                                />
                            </QuestionProvider>
                        );
                    }
                })}
            </div>

            {loading && (
                <div className="text-center mt-4">
                    <div className="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-blue-500 border-solid"></div>
                    <p className="mt-2 text-sm text-gray-500">Loading...</p>
                </div>
            )}
        </div>
    );
};

export default CommentList;
