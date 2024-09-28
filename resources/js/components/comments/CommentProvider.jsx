// QuestionContext.js
import React, { createContext, useState } from "react";

export const QuestionContext = createContext();

export const QuestionProvider = ({ children }) => {
    const [replies, setReplies] = useState([]);

    return (
        <QuestionContext.Provider value={{ replies, setReplies }}>
            {children}
        </QuestionContext.Provider>
    );
};
