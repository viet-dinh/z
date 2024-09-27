import React, { createContext, useContext, useState } from 'react';

// Create AuthContext
const AuthContext = createContext();

// Create a provider component
export const AuthProvider = ({ children, authUserId }) => {
    const [userId] = useState(authUserId);

    return (
        <AuthContext.Provider value={{authId: userId}}>
            {children}
        </AuthContext.Provider>
    );
};

// Hook to use auth context in any component
export const useAuth = () => {
    return useContext(AuthContext);
};
