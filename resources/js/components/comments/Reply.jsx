import React, { useState } from 'react';
import Reaction from './Reaction';

const Reply = ({ reply }) => {
    const [reactionsVisible, setReactionsVisible] = useState(false);

    const toggleReactions = () => setReactionsVisible(!reactionsVisible);

    return (
        <div className="card mb-2">
            <div className="card-body">
                <p>{reply.content}</p>
                <div className="d-flex gap-2">
                    <Reaction
                        reactableType="reply"
                        reactableId={reply.id}
                        initialReactions={reply.reactions}
                    />
                </div>
                <div className="d-flex justify-content-between">
                    <button className="btn btn-light btn-sm" onClick={toggleReactions}>
                        <i className="far fa-smile"></i> React
                    </button>
                </div>

                {reactionsVisible && (
                    <div className="mt-2">
                        {/* Add buttons to handle adding reactions */}
                    </div>
                )}
            </div>
        </div>
    );
};

export default Reply;
