import React, { useState } from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faSmile } from "@fortawesome/free-solid-svg-icons";
import Popper from "@mui/material/Popper";
import Button from "@mui/material/Button";
import Paper from "@mui/material/Paper";
import ClickAwayListener from "@mui/material/ClickAwayListener";
import { useAuth } from "../../AuthProvider";
import { Box, IconButton } from "@mui/material";
import { styled } from "@mui/material/styles";
import api from "../../api";

// Import SVG icons
import LikeIcon from "../../../icons/reactions/like.svg";
import LoveIcon from "../../../icons/reactions/love.svg";
import LaughIcon from "../../../icons/reactions/laugh.svg";
import WowIcon from "../../../icons/reactions/wow.svg";
import SadIcon from "../../../icons/reactions/sad.svg";
import AngryIcon from "../../../icons/reactions/angry.svg";
import AddReaction from "../../../icons/reactions/add-reaction.svg";

// Map icons to reaction types
const REACTION_ICONS = {
    0: LikeIcon,
    1: LoveIcon,
    2: LaughIcon,
    3: WowIcon,
    4: SadIcon,
    5: AngryIcon,
};

export const REACTION_TYPES = {
    LIKE: 0,
    LOVE: 1,
    LAUGH: 2,
    WOW: 3,
    SAD: 4,
    ANGRY: 5,
};

const Reaction = ({ reactableType, reactableId, initialReactions }) => {
    const { authId } = useAuth();
    const [reactions, setReactions] = useState(initialReactions ?? []);
    const [anchorEl, setAnchorEl] = useState(null);

    const reactionCounts = Object.keys(REACTION_TYPES).reduce((acc, key) => {
        const type = REACTION_TYPES[key];
        let count = 0;
        let isCheckedByMine = false;

        reactions.forEach((reaction) => {
            if (reaction.type === type) {
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

    const handleReactionClick = async ({ type, reaction }) => {
        try {
            await api
                .post(`/reactions/${reactableType}/${reactableId}`, {
                    type,
                })
                .then((response) => {
                    if (response.data === 0) {
                        if (reaction) {
                            setReactions((previous) =>
                                previous.filter((r) => r.id !== reaction.id)
                            );
                        }
                    } else {
                        setReactions((previous) => [
                            ...previous,
                            response.data,
                        ]);
                    }
                });
        } catch (error) {
            console.error("Error updating reaction:", error);
        }
        setAnchorEl(null); // Close the emoji picker
    };

    const togglePicker = (event) => {
        setAnchorEl(anchorEl ? null : event.currentTarget);
    };

    const handleClose = () => {
        setAnchorEl(null);
    };

    const open = Boolean(anchorEl);
    const id = open ? "reaction-popper" : undefined;

    return (
        <div className="flex flex-wrap items-center gap-2">
            {Object.values(reactionCounts).map(({ type, active, count }) => (
                <button
                    key={type}
                    onClick={() =>
                        handleReactionClick({
                            type,
                            reaction: reactions
                                .filter(
                                    (x) =>
                                        x.user_id == authId && x.type === type
                                )
                                .pop(),
                        })
                    }
                    title={type}
                    className={`flex reaction-button items-center space-x-2 rounded-lg border ${
                        count === 0 ? "hidden" : "inline-flex"
                    } ${
                        active ? "highlight" : ""
                    } hover:bg-gray-200 transition-all duration-200 ease-in-out cursor-pointer`}
                >
                    <img
                        src={REACTION_ICONS[type]}
                        width={18}
                        height={18}
                        alt={type}
                        className="object-contain"
                    />
                    <span className="text-sm ml-1 font-medium">{count}</span>
                </button>
            ))}

            <IconButton onClick={togglePicker}>
                <img
                    src={AddReaction}
                    width={18}
                    height={18}
                    alt={"Thêm reaction"}
                />
            </IconButton>

            {/* Popper component for the emoji picker */}
            <Popper
                id={id}
                open={open}
                anchorEl={anchorEl}
                placement="bottom-start"
            >
                <ClickAwayListener onClickAway={handleClose}>
                    <Paper className="p-2 flex flex-wrap gap-4">
                        {Object.keys(REACTION_TYPES).map((key) => {
                            const type = REACTION_TYPES[key];
                            return (
                                <div
                                    key={type}
                                    onClick={() =>
                                        handleReactionClick({
                                            type,
                                            reaction: reactions
                                                .filter(
                                                    (x) =>
                                                        x.user_id == authId &&
                                                        x.type === type
                                                )
                                                .pop(),
                                        })
                                    }
                                    className="reaction-icon"
                                >
                                    <img
                                        src={REACTION_ICONS[type]}
                                        alt={key}
                                        className="reaction-img"
                                    />
                                </div>
                            );
                        })}
                    </Paper>
                </ClickAwayListener>
            </Popper>
        </div>
    );
};

export default Reaction;
