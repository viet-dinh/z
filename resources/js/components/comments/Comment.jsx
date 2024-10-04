import React, { useContext, useEffect, useState } from "react";
import { formatDistanceToNow } from "date-fns";
import ReplyList from "./ReplyList";
import Reaction from "./Reaction.jsx";
import vi from "date-fns/locale/vi";
import ReplyForm from "./ReplyForm.jsx";
import { QuestionContext } from "./CommentProvider.jsx";
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
import Content from "./Content.jsx";
import api from "../../api.js";
import MoreHoriz from "@mui/icons-material/MoreHoriz";

const Comment = ({ comment, onDelete }) => {
    const { setReplies } = useContext(QuestionContext);
    const [isShowReplyForm, setIsShowReplyForm] = useState(false);
    const [openDeleteDialog, setOpenDeleteDialog] = useState(false); // State to control dialog visibility
    const [anchorEl, setAnchorEl] = useState(null);

    useEffect(() => {
        setReplies(comment?.replies ?? []);
    }, []);

    const timeAgo = formatDistanceToNow(new Date(comment.updated_at), {
        addSuffix: true,
        locale: vi,
    });

    const handleDeleteComment = async () => {
        try {
            await api
                .delete(`/comments/${comment.id}`)
                .then((r) => onDelete(comment.id));
        } catch (error) {
            console.error("Error deleting comment:", error);
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
        <div className="bg-white shadow-md rounded-lg p-4 mb-4">
            <div className="flex justify-between items-center mb-2">
                <span className="text-sm">
                    <strong className="font-semibold">
                        {comment.user.name}
                    </strong>
                    {comment.chapter_order && <span className="text-secondary"> - Chương {comment.chapter_order}</span>}
                    <span className="text-secondary"> - {timeAgo}</span>
                </span>

                {comment.canDelete && (
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

            <Content value={comment.content} />

            <div className="flex gap-2 mt-2 reply-container">
                <Reaction
                    reactableType="comment"
                    reactableId={comment.id}
                    initialReactions={comment.reactions}
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
                    replyTo={`@${comment.user?.name} `}
                    commentId={comment.id}
                    addNewReply={(newReply) => {
                        setReplies((previous) => [...previous, newReply]);
                        setIsShowReplyForm(false);
                    }}
                />
            )}

            {/* Show the reply list with the expand/collapse functionality */}
            <ReplyList commentId={comment.id} />

            {/* Delete Confirmation Dialog */}
            <Dialog
                open={openDeleteDialog}
                onClose={() => setOpenDeleteDialog(false)}
                aria-labelledby="alert-dialog-title"
                aria-describedby="alert-dialog-description"
            >
                <DialogTitle id="alert-dialog-title">
                    {"Xác nhận xóa bình luận này"}
                </DialogTitle>
                <DialogContent>
                    <DialogContentText id="alert-dialog-description">
                        Bình luận
                        <Typography
                            variant="p"
                            className="mt-2 bg-yellow-200 p-2 rounded shadow-lg"
                        >
                            {comment.content.length <= 32
                                ? comment.content
                                : comment.content.slice(0, 32) + "..."}
                        </Typography>
                        và tất cả trả lời của nó sẽ được ẩn đi
                    </DialogContentText>
                </DialogContent>
                <DialogActions>
                    <Button
                        onClick={() => setOpenDeleteDialog(false)}
                        color="primary"
                    >
                        Hủy
                    </Button>
                    <Button
                        onClick={handleDeleteComment}
                        color="error"
                        autoFocus
                    >
                        Xóa
                    </Button>
                </DialogActions>
            </Dialog>
        </div>
    );
};

export default Comment;
