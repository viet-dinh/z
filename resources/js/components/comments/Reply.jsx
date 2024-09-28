import React, { useContext, useState } from "react";
import Reaction from "./Reaction";
import { formatDistanceToNow } from "date-fns";
import vi from "date-fns/locale/vi";
import { QuestionContext } from "./CommentProvider";
import ReplyForm from "./ReplyForm";
import { Button } from "@mui/material";

const Reply = ({ reply, setReplyTo }) => {
    const { setReplies } = useContext(QuestionContext);
    const [isShowReplyForm, setIsShowReplyForm] = useState(false);

    const timeAgo = formatDistanceToNow(new Date(reply.updated_at), {
        addSuffix: true,
        locale: vi,
    });

    return (
        <div className="bg-gray-100 shadow-sm rounded-lg p-4 mb-2">
            <div className="flex justify-between items-center mb-2">
                <span className="text-sm">
                    <strong className="font-semibold">{reply.user.name}</strong>{" "}
                    <span className="text-secondary"> - {timeAgo}</span>
                </span>
            </div>

            <p className="text-gray-700">{reply.content}</p>

            <div class="flex gap-2 mt-2 reply-container">
                <Reaction
                    reactableType="reply"
                    reactableId={reply.id}
                    initialReactions={reply.reactions}
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
                    replyTo={`@${reply.user?.name} `}
                    commentId={reply.comment_id}
                    addNewReply={(newReply) => {
                        setReplies((previous) => [...previous, newReply]);
                        setIsShowReplyForm(false);
                    }}
                />
            )}
        </div>
    );
};

export default Reply;
