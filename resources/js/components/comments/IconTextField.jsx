import React, { useState } from "react";
import { TextField, IconButton, InputAdornment } from "@mui/material";
import SendIcon from "@mui/icons-material/Send";
import Picker from "@emoji-mart/react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faSmile } from "@fortawesome/free-solid-svg-icons";
import ClickAwayListener from "@mui/material/ClickAwayListener"; // Import ClickAwayListener

const IconTextField = ({ value, onChange, onSubmit, placeholder }) => {
    const [error, setError] = useState("");
    const [showEmojiPicker, setShowEmojiPicker] = useState(false);

    const handleSubmit = () => {
        const isTooShort = !value?.trim() || value.trim().length < 2;

        if (isTooShort) {
            setError("Nhập ít nhất 2 ký tự");
        } else {
            setError(false);
            onSubmit();
        }
    };

    const addEmoji = (emoji) => {
        onChange({
            target: {
                value: value + emoji.native, // Append emoji to the input
            },
        });
    };

    const handleClickAway = () => {
        setShowEmojiPicker(false); // Close emoji picker when clicking away
    };

    return (
        <>
            <TextField
                sx={{
                    "& .MuiOutlinedInput-root": {
                        "& fieldset": {
                            borderColor: error ? "red" : "gray",
                        },
                        "&:hover fieldset": {
                            borderColor: error ? "red" : "black",
                        },
                        "&.Mui-focused fieldset": {
                            borderColor: error ? "red" : "black",
                        },
                    },
                }}
                value={value}
                onChange={(e) => {
                    setError(false);
                    onChange(e);
                }}
                onKeyDown={(e) => {
                    if (e.key === "Enter") {
                        if (e.shiftKey) {
                            return;
                        }

                        e.preventDefault();
                        handleSubmit();
                    }
                }}
                multiline
                rows={3}
                variant="outlined"
                placeholder={placeholder}
                fullWidth
                inputProps={{
                    maxLength: 1024, // Set maxLength here
                }}
                InputProps={{
                    endAdornment: (
                        <InputAdornment position="end">
                            <IconButton
                                onClick={() =>
                                    setShowEmojiPicker(!showEmojiPicker)
                                }
                                title="Thêm icons"
                            >
                                <FontAwesomeIcon
                                    style={{ color: "#667085" }} //
                                    icon={faSmile}
                                />
                            </IconButton>

                            <IconButton onClick={handleSubmit}>
                                <SendIcon />
                            </IconButton>
                        </InputAdornment>
                    ),
                }}
                error={!!error}
                helperText={error}
            />

            {/* Emoji Picker with ClickAwayListener */}
            {showEmojiPicker && (
                <ClickAwayListener onClickAway={handleClickAway}>
                    <div style={{ position: "absolute", zIndex: 1 }}>
                        <Picker onEmojiSelect={addEmoji} />{" "}
                        {/* Use new picker component */}
                    </div>
                </ClickAwayListener>
            )}
        </>
    );
};

export default IconTextField;
