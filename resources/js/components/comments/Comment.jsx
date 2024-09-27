import React, { useState } from "react";
import { formatDistanceToNow } from 'date-fns';
import ReplyList from "./ReplyList";
import Reaction from "./Reaction.jsx";
import vi from 'date-fns/locale/vi'
import { useAuth } from "../../AuthProvider.jsx";

const Comment = ({ comment }) => {
    const {authId} = useAuth();
    const [showReplyForm, setShowReplyForm] = useState(false);

    const toggleReplyForm = () => {
        setShowReplyForm(!showReplyForm);
    };

    // Format time ago
    const timeAgo = formatDistanceToNow(new Date(comment.updated_at), {
        addSuffix: true,
        locale: vi
    },);

    return (
        <div className="card mb-4">
            <div className="card-body">
                <div className="d-flex justify-content-between align-items-center">
                    <span>
                        <strong>{comment.user.name}</strong> - {timeAgo}
                    </span>
                </div>

                <p>{comment.content}</p>

                <div className="d-flex gap-2">
                    <Reaction
                        reactableType="comment"
                        reactableId={comment.id}
                        initialReactions={comment.reactions}
                    />
                </div>

                <div className="d-flex justify-content-between">
                    <button className="btn btn-link btn-sm" onClick={toggleReplyForm}>
                        Reply
                    </button>
                </div>

                {showReplyForm && (
                    <form
                        className="mt-3"
                        onSubmit={(e) => {
                            e.preventDefault();
                            alert("Submit reply");
                        }}
                    >
                        <div className="form-group">
                            <textarea
                                rows="2"
                                className="form-control"
                                placeholder="Add your reply here..."
                            />
                        </div>
                        <button type="submit" className="btn btn-primary">
                            Submit Reply
                        </button>
                    </form>
                )}

                <ReplyList replies={comment.replies} />
            </div>
        </div>
    );
};

export default Comment;
