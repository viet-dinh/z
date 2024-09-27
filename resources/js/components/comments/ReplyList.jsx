import React from "react";
import Reply from "./Reply";

const ReplyList = ({ replies }) => {
    if (!replies) {
        return;
    }

    return (
        <div className="ml-4 mt-3">
            {replies.map(reply => (
                <Reply key={reply.id} reply={reply} />
            ))}
        </div>
    );
};

export default ReplyList;
