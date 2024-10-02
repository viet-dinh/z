import React, { useContext, useState } from "react";
import Reaction from "./Reaction";
import { formatDistanceToNow } from "date-fns";
import vi from "date-fns/locale/vi";
import {
    Button,
    IconButton,
    Dialog,
    DialogActions,
    DialogContent,
    DialogContentText,
    DialogTitle,
    Typography,
    Menu,
    MenuItem,
} from "@mui/material";
import DeleteIcon from "@mui/icons-material/DeleteOutline";
import MoreHoriz from "@mui/icons-material/MoreHoriz";
import ReplyForm from "./ReplyForm";
import { QuestionContext } from "./CommentProvider";
import api from "../../api.js";

const Reply = ({ reply, onDelete }) => {
    const { replies, setReplies } = useContext(QuestionContext);
    const [isShowReplyForm, setIsShowReplyForm] = useState(false);
    const [openDeleteDialog, setOpenDeleteDialog] = useState(false);
    const [anchorEl, setAnchorEl] = useState(null);

    const timeAgo = formatDistanceToNow(new Date(reply.updated_at), {
        addSuffix: true,
        locale: vi,
    });

    const handleDeleteReply = async () => {
        try {
            await api
                .delete(`/replies/${reply.id}`)
                .then(() =>
                    setReplies(replies.filter((r) => r.id != reply.id))
                );
        } catch (error) {
            console.error("Error deleting reply:", error);
        } finally {
            setOpenDeleteDialog(false);
        }
    };

    const handleMenuClick = (event) => {
        setAnchorEl(event.currentTarget);
    };

    const handleMenuClose = () => {
        setAnchorEl(null);
    };

    return (
        <div className="bg-gray-100 shadow-sm rounded-lg p-4 mb-2">
            <div className="flex justify-between items-center mb-2">
                <span className="text-sm">
                    <strong className="font-semibold">{reply.user.name}</strong>{" "}
                    <span className="text-secondary"> - {timeAgo}</span>
                </span>
                {reply.canDelete && (
                    <div>
                        <IconButton onClick={handleMenuClick} size="small">
                            <MoreHoriz fontSize="small" />{" "}
                        </IconButton>
                        <Menu
                            anchorEl={anchorEl}
                            open={Boolean(anchorEl)}
                            onClose={handleMenuClose}
                        >
                            <MenuItem onClick={() => setOpenDeleteDialog(true)}>
                                <DeleteIcon fontSize="small" className="mr-2" />
                                Xóa
                            </MenuItem>
                        </Menu>
                    </div>
                )}
            </div>

            <p className="text-gray-700" style={{ whiteSpace: "pre-line" }}>
                {reply.content}
            </p>

            <div className="flex gap-2 mt-2 reply-container">
                <Reaction
                    reactableType="reply"
                    reactableId={reply.id}
                    initialReactions={reply.reactions}
                />
                <div>
                    <Button
                        sx={{
                            textTransform: "none",
                        }}
                        variant="text"
                        className="text-sm text-secondary normal-case"
                        onClick={() => setIsShowReplyForm(!isShowReplyForm)}
                    >
                        Trả lời
                    </Button>
                </div>
            </div>

            {isShowReplyForm && (
                <ReplyForm
                    replyTo={`@${reply.user?.name} `}
                    commentId={reply.comment_id}
                    addNewReply={(newReply) => {
                        setReplies((previous) => [...previous, newReply]);
                        setIsShowReplyForm(false);
                    }}
                />
            )}

            {/* Delete Confirmation Dialog */}
            <Dialog
                open={openDeleteDialog}
                onClose={() => setOpenDeleteDialog(false)}
                aria-labelledby="alert-dialog-title"
                aria-describedby="alert-dialog-description"
            >
                <DialogTitle id="alert-dialog-title">
                    {"Xác nhận xóa trả lời này"}
                </DialogTitle>
                <DialogContent>
                    <DialogContentText id="alert-dialog-description">
                        Trả lời
                        <Typography
                            variant="p"
                            className="mt-2 bg-yellow-200 p-2 rounded shadow-lg"
                        >
                            {reply.content.length <= 32
                                ? reply.content
                                : reply.content.slice(0, 32) + "..."}
                        </Typography>
                        sẽ bị xóa
                    </DialogContentText>
                </DialogContent>
                <DialogActions>
                    <Button
                        onClick={() => setOpenDeleteDialog(false)}
                        color="primary"
                    >
                        Hủy
                    </Button>
                    <Button onClick={handleDeleteReply} color="error" autoFocus>
                        Xóa
                    </Button>
                </DialogActions>
            </Dialog>
        </div>
    );
};

export default Reply;
