import "./bootstrap";
import "./app.js";

import ReactDOM from "react-dom/client";
import React from "react";
import { ThemeProvider } from "@mui/material/styles";
import CssBaseline from "@mui/material/CssBaseline";
import theme from "./theme";
import { AuthProvider } from "./AuthProvider.jsx";
import { AppProvider } from "./AppProvider.jsx";
import Social from "./components/social.jsx";

const socialDiv = document.getElementById("root");
const storyId = socialDiv.getAttribute("story-id");
const chapterOrder = socialDiv.getAttribute("chapter-order");
const authUserId = socialDiv.getAttribute("auth-user-id");
ReactDOM.createRoot(socialDiv).render(
    <ThemeProvider theme={theme}>
        <CssBaseline />
        <AuthProvider authUserId={authUserId}>
            <AppProvider
                data={{
                    storyId,
                    chapterOrder,
                }}
            >
                <Social />
            </AppProvider>
        </AuthProvider>
    </ThemeProvider>
);
