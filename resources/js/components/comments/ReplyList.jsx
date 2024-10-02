import React, { useContext, useEffect, useState } from "react";
import Reply from "./Reply";
import { QuestionContext } from "./CommentProvider";

const ReplyList = ({ commentId }) => {
    const { replies } = useContext(QuestionContext);
    const [isExpanded, setIsExpanded] = useState(false);

    useEffect(() => {
        if (!replies.length) return;

        setIsExpanded(true);
    }, [replies]);

    return (
        <div className="ml-4 mt-3">
            {replies.length > 0 && (
                <button
                    onClick={() => setIsExpanded(!isExpanded)}
                    className="text-blue-500 hover:underline text-sm mb-2 text-secondary"
                >
                    {isExpanded
                        ? `Ẩn trả lời (${replies.length})`
                        : `Xem trả lời (${replies.length})`}
                </button>
            )}

            {isExpanded &&
                replies.map((reply) => <Reply key={reply.id} reply={reply} />)}
        </div>
    );
};

export default ReplyList;
