import React from "react";
import TextField from "@mui/material/TextField";
import InputAdornment from "@mui/material/InputAdornment";
import IconButton from "@mui/material/IconButton";
import SendIcon from "@mui/icons-material/Send"; // Replace with your desired icon

const IconTextField = ({ value, onChange, onSubmit, placeholder }) => {
    return (
        <TextField
            sx={{
                "& .MuiOutlinedInput-root": {
                    "& fieldset": {
                        borderColor: "gray", // Initial border color
                    },
                    "&:hover fieldset": {
                        borderColor: "black", // Border color on hover
                    },
                    "&.Mui-focused fieldset": {
                        borderColor: "black", // Border color when focused
                    },
                },
            }}
            value={value}
            onChange={onChange}
            onKeyDown={(e) => {
                if (e.key === "Enter") {
                    e.preventDefault(); // Prevent default form submission
                    onSubmit();
                }
            }} // Add onKeyDown prop here
            multiline
            rows={3}
            variant="outlined"
            placeholder={placeholder}
            fullWidth
            InputProps={{
                endAdornment: (
                    <InputAdornment position="end">
                        <IconButton onClick={onSubmit}>
                            <SendIcon /> {/* Replace with your icon */}
                        </IconButton>
                    </InputAdornment>
                ),
            }}
        />
    );
};

export default IconTextField;
