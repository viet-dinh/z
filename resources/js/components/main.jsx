import {
    Box,
    IconButton,
    List,
    ListItem,
    ListItemText,
    Typography,
} from "@mui/material";
import React, { useEffect, useState } from "react";

export default function Main() {
    const [currentUsers, setCurrentUser] = useState([]);

    const handleNewJoin = (user) => {
        if (currentUsers.find((u) => u.id === user.id)) {
            return;
        }
        setCurrentUser([...currentUsers, user]);
    };

    const handleLeaving = (user) => {
        let newUsers = currentUsers.filter((u) => u.id !== user.id);
        setCurrentUser(newUsers);
    };

    Echo.join(`app`)
        .here((users) => {
            console.log(users);
            setCurrentUser(users);
        })
        .joining(handleNewJoin)
        .leaving(handleLeaving)
        .listen("UserLogginedApp", (e) => {
            console.log(e);
        })
        .error((error) => {
            console.error(error);
        });

    return (
        <Box>
            <Typography variant="h1">Who are viewing this page</Typography>

            <List
                sx={{
                    width: "100%",
                    bgcolor: "blue",
                }}
            >
                {currentUsers.map(({ id, name, email }) => (
                    <ListItem key={id} disableGutters>
                        <ListItemText
                            primary={`User: ${name} with email ${email}`}
                        />
                    </ListItem>
                ))}
            </List>
        </Box>
    );
}
