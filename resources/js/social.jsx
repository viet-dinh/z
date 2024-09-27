import "./bootstrap";
import "./app.js";

import ReactDOM from "react-dom/client";
import React from "react";
import { ThemeProvider } from "@mui/material/styles";
import CssBaseline from "@mui/material/CssBaseline";
import theme from "./theme";
import { CommentList } from "./components/comments/CommentList.jsx";

const socialDiv = document.getElementById('social');
const storyId = socialDiv.getAttribute('story-id');  // Get the story ID from the div
console.log(storyId, 'ss')
ReactDOM.createRoot(socialDiv).render(
    <ThemeProvider theme={theme}>
        <CssBaseline />
    </ThemeProvider>
);
