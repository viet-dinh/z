import React, { useState, useEffect, useRef, useCallback } from "react";
import axios from "axios";
import Comment from "./Comment";

const CommentList = ({ storyId }) => {
    const [comments, setComments] = useState([]);
    const [newComment, setNewComment] = useState("");
    const [page, setPage] = useState(1);
    const [hasMore, setHasMore] = useState(true);
    const [loading, setLoading] = useState(false);
    const observer = useRef();

    useEffect(() => {
        loadComments(page);
    }, [page]);

    const loadComments = (pageNumber) => {
        setLoading(true);
        axios
            .get(`/api/v1/stories/${storyId}/comments?page=${pageNumber}`)
            .then((response) => {
                const newComments = response.data.data;
                setComments((prevComments) => [...prevComments, ...newComments]);
                setHasMore(response.data.current_page < response.data.last_page);
                setLoading(false);
            })
            .catch((error) => {
                console.error("Error fetching comments:", error);
                setLoading(false);
            });
    };

    const handleSubmitComment = (e) => {
        e.preventDefault();
        axios
            .post(`/api/v1/stories/${storyId}/comments`, { content: newComment })
            .then((response) => {
                setComments([response.data, ...comments]);
                setNewComment("");
            })
            .catch((error) => console.error("Error submitting comment:", error));
    };

    const lastCommentRef = useCallback(
        (node) => {
            if (observer.current) observer.current.disconnect();
            observer.current = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting && hasMore && !loading) {
                    setPage((prevPage) => prevPage + 1);
                }
            });
            if (node) observer.current.observe(node);
        },
        [hasMore, loading]
    );

    return (
        <div className="mt-5">
            <h2 className="h3">Comments</h2>

            <form onSubmit={handleSubmitComment}>
                <div className="form-group">
                    <textarea
                        value={newComment}
                        onChange={(e) => setNewComment(e.target.value)}
                        rows="3"
                        className="form-control"
                        placeholder="Add your comment here..."
                    />
                </div>
                <button type="submit" className="btn btn-primary">
                    Submit Comment
                </button>
            </form>

            <div className="mt-5">
                {comments.map((comment, index) => {
                    if (comments.length === index + 1) {
                        return (
                            <div ref={lastCommentRef} key={comment.id}>
                                <Comment comment={comment} />
                            </div>
                        );
                    } else {
                        return <Comment key={comment.id} comment={comment} />;
                    }
                })}
            </div>

            {loading && (
                <div className="text-center mt-4">
                    <div className="spinner-border" role="status">
                        <span className="sr-only">Loading...</span>
                    </div>
                </div>
            )}
        </div>
    );
};

export default CommentList;
