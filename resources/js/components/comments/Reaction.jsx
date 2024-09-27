import React, { useState } from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faSmile } from "@fortawesome/free-solid-svg-icons";
import axios from "axios";
import Popper from "@mui/material/Popper";
import Button from "@mui/material/Button";
import Paper from "@mui/material/Paper";
import ClickAwayListener from "@mui/material/ClickAwayListener";
import { useAuth } from "../../AuthProvider";
import { Box } from '@mui/material';
import { styled } from '@mui/material/styles';

export const REACTION_TYPES = {
    LIKE: 0,
    LOVE: 1,
    LAUGH: 2,
    WOW: 3,
    SAD: 4,
    ANGRY: 5,
};

export const REACTION_EMOJIS = {
    [REACTION_TYPES.LIKE]: "👍",
    [REACTION_TYPES.LOVE]: "❤️",
    [REACTION_TYPES.LAUGH]: "😂",
    [REACTION_TYPES.WOW]: "😮",
    [REACTION_TYPES.SAD]: "😢",
    [REACTION_TYPES.ANGRY]: "😡",
};

const HighlightedIcon = styled(Box)(({ theme }) => ({
    backgroundColor: 'yellow',
    borderRadius: '4px',
    padding: '2px',
    // You can also add hover effects or other styles here
    '&:hover': {
        backgroundColor: 'lightyellow',
    },
}));

const Reaction = ({ reactableType, reactableId, initialReactions }) => {
    const {authId} = useAuth();
    const [reactions, setReactions] = useState(initialReactions ?? []);
    const [anchorEl, setAnchorEl] = useState(null);

    // Group reactions by type and count them
    const reactionCounts = Object.keys(REACTION_TYPES).reduce((acc, key) => {
        const type = REACTION_TYPES[key];
        var count = 0;

        var isCheckedByMine = false;
        reactions.forEach(reaction => {
            if(reaction.type === type) {
                count++;

                if (reaction.user_id == authId) {
                    isCheckedByMine = true;
                }
            }
        });

        acc[type] = {
            type,
            count,
            active: isCheckedByMine,
        };

        return acc;
    }, {});

    const handleReactionClick = async ({type, reaction}) => {
        try {
            console.log(reaction)
            await axios.post(`/api/v1/reactions/${reactableType}/${reactableId}`, {
                type
            }).then(response => {
                //deleted
                if (response.data === 0 ) {
                    if (reaction) {
                        setReactions(previous => previous.filter(r => r.id !== reaction.id));
                    }
                } else {
                    setReactions(previous => [...previous, response.data]);
                }
            });
        } catch (error) {
            console.error("Error updating reaction:", error);
        }

        setAnchorEl(null);  // Close the emoji picker
    };

    const togglePicker = (event) => {
        setAnchorEl(anchorEl ? null : event.currentTarget);
    };

    const handleClose = () => {
        setAnchorEl(null);
    };

    const open = Boolean(anchorEl);
    const id = open ? 'reaction-popper' : undefined;

    return (
        <div className="d-flex align-items-center">
            {/* Display each reaction icon with count */}
            {Object.values(reactionCounts).map(( {type, active, count}) => (
                <Box 
                    key={type}
                    title={type}
                    className={`reaction-icon ${count === 0 ? 'd-none' : ''} ${active ? 'highlight' : ''} `} >
                         {REACTION_EMOJIS[type]} {count}
                </Box>
            ))}

            {/* FontAwesome smile icon as a placeholder */}
            <div className="reaction-icon" onClick={togglePicker} title="Add Reaction">
                <FontAwesomeIcon icon={faSmile} />
            </div>

            {/* Popper component for the emoji picker */}
            <Popper id={id} open={open} anchorEl={anchorEl} placement="bottom-start">
                <ClickAwayListener onClickAway={handleClose}>
                    <Paper style={{ padding: '10px', display: 'flex', flexWrap: 'wrap', gap: '10px' }}>
                        {Object.keys(REACTION_TYPES).map((key) => {
                            const type = REACTION_TYPES[key];
                            return (
                                <Button
                                    key={type}
                                    onClick={() => handleReactionClick({ type, reaction: reactions.filter(x=> x.user_id == authId && x.type === type).pop() })}
                                    style={{ minWidth: '40px', padding: '5px' }}
                                >
                                    {REACTION_EMOJIS[type]}
                                </Button>
                            );
                        })}
                    </Paper>
                </ClickAwayListener>
            </Popper>
        </div>
    );
};

export default Reaction;
