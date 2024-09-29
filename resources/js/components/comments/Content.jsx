import React, { useState } from "react";
import { Typography } from "@mui/material";

const Content = ({ value }) => {
    const [isExpanded, setIsExpanded] = useState(false);
    const isLongComment = value?.length > 128;

    const handleToggle = () => {
        setIsExpanded(!isExpanded);
    };

    return (
        <div className="bg-white p-4 rounded-lg mb-4">
            <Typography
                className="text-gray-700 inline"
                style={{
                    whiteSpace: "pre-line",
                    overflowWrap: "break-word",
                    wordBreak: "break-word",
                }}
            >
                {isExpanded ? value : `${value.slice(0, 128)}`}
                {isLongComment && (
                    <Typography
                        variant="body2"
                        component={"span"}
                        onClick={handleToggle}
                        className="text-blue-500 underline cursor-pointer inline ml-2 text-secondary"
                    >
                        {isExpanded ? "Thu lại" : "Xem thêm"}
                    </Typography>
                )}
            </Typography>
        </div>
    );
};

export default Content;
