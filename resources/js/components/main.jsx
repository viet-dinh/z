import {
    Box,
    IconButton,
    List,
    ListItem,
    ListItemText,
    Typography,
    TextField,
    Button,
} from "@mui/material";
import React, { useEffect, useState } from "react";

export default function Main() {
    const [currentUsers, setCurrentUsers] = useState([]);
    const [messageInput, setMessageInput] = useState("");

    const [messages, setMessages] = useState([]);

    useEffect(() => {
        const chanel = Echo.join(`chats.all`)
            .here((users) => {
                console.log(users, "here");
                setCurrentUsers(users);
            })
            .joining((user) => {
                console.log(`${user.name} joined`);
                setCurrentUsers((prevUsers) =>
                    prevUsers.find((u) => u.id === user.id) === undefined
                        ? [...prevUsers, user]
                        : prevUsers
                );
            })
            .leaving((user) => {
                console.log(`${user.name} left`);
                setCurrentUsers((prevUsers) =>
                    prevUsers.filter((u) => u.id !== user.id)
                );
            })
            .listen(".message.to.all", (data) => {
                setMessages((messages) => [...messages, data.message]);
            })
            .error((error) => {
                console.error(error);
            });

        return () => console.log(chanel.unsubscribe());
    }, []);

    const sendMessage = () => {
        // Post message to /chat/message-all
        fetch("/api/chat/message-all", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ message: messageInput }),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log("Message sent:", data);
                // Optionally, you can update the UI or display a success message
            })
            .catch((error) => {
                console.error("Error sending message:", error);
                // Handle error
            });

        // Clear the message input field after sending
        setMessageInput("");
    };

    return (
        <Box>
            {/* Message input and send button */}
            <Box mt={2}>
                <TextField
                    label="Message"
                    variant="outlined"
                    value={messageInput}
                    onChange={(e) => setMessageInput(e.target.value)}
                    fullWidth
                />
                <Button
                    variant="contained"
                    color="primary"
                    onClick={sendMessage}
                    disabled={!messageInput.trim()} // Disable button if messageInput is empty or contains only whitespace
                >
                    Send
                </Button>
            </Box>

            <Typography variant="h3">Who are viewing this page</Typography>

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

            <Box>
                <Typography variant="h3">Messages</Typography>

                <List
                    sx={{
                        width: "100%",
                        bgcolor: "yellow",
                    }}
                >
                    {messages.map((message, i) => (
                        <ListItem key={i} disableGutters>
                            <ListItemText primary={message} />
                        </ListItem>
                    ))}
                </List>
            </Box>
        </Box>
    );
}
