import React, { useContext, useEffect, useState } from "react";
import { formatDistanceToNow } from "date-fns";
import ReplyList from "./ReplyList";
import Reaction from "./Reaction.jsx";
import vi from "date-fns/locale/vi";
import ReplyForm from "./ReplyForm.jsx";
import { QuestionContext } from "./CommentProvider.jsx";
import { Button } from "@mui/material";

const Comment = ({ comment }) => {
    const { setReplies } = useContext(QuestionContext);
    const [isShowReplyForm, setIsShowReplyForm] = useState(false);

    useEffect(() => {
        setReplies(comment?.replies ?? []);
    }, []);

    const timeAgo = formatDistanceToNow(new Date(comment.updated_at), {
        addSuffix: true,
        locale: vi,
    });

    return (
        <div className="bg-white shadow-md rounded-lg p-4 mb-4">
            <div className="flex justify-between items-center mb-2">
                <span className="text-sm">
                    <strong className="font-semibold">
                        {comment.user.name}
                    </strong>{" "}
                    <span className="text-secondary"> - {timeAgo}</span>
                </span>
            </div>

            <p className="text-gray-700">{comment.content}</p>

            <div className="flex gap-2 mt-2 reply-container">
                <Reaction
                    reactableType="comment"
                    reactableId={comment.id}
                    initialReactions={comment.reactions}
                />

                <div>
                    <Button
                        sx={{
                            textTransform: "none",
                        }}
                        variant="text"
                        className="text-sm text-secondary normal-case"
                        onClick={() => setIsShowReplyForm(!isShowReplyForm)}
                    >
                        Trả lời
                    </Button>
                </div>
            </div>

            {isShowReplyForm && (
                <ReplyForm
                    replyTo={`@${comment.user?.name} `}
                    commentId={comment.id}
                    addNewReply={(newReply) => {
                        setReplies((previous) => [...previous, newReply]);
                        setIsShowReplyForm(false);
                    }}
                />
            )}

            {/* Show the reply list with the expand/collapse functionality */}
            <ReplyList commentId={comment.id} />
        </div>
    );
};

export default Comment;
