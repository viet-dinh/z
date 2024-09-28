import React, { useEffect, useState } from "react";
import api from "../../api";
import IconTextField from "./IconTextField";

const ReplyForm = ({ commentId, replyTo, addNewReply }) => {
    const [newReply, setNewReply] = useState("");

    useEffect(() => {
        setNewReply(replyTo);
    }, [replyTo]);

    const handleSubmitReply = () => {
        api.post(`/comments/${commentId}/replies`, {
            content: newReply,
        })
            .then(({ data }) => {
                addNewReply(data);
            })
            .catch((error) =>
                console.error("Error submitting comment:", error)
            );
    };

    return (
        <div className="ml-4 mt-3">
            <form
                className="mt-3"
                onSubmit={(e) => {
                    e.preventDefault();
                    handleSubmitReply();
                }}
            >
                <div className="form-group">
                    <IconTextField
                        value={newReply}
                        onChange={(e) => setNewReply(e.target.value)}
                        onSubmit={() => handleSubmitReply()}
                    />
                </div>
            </form>
        </div>
    );
};

export default ReplyForm;
