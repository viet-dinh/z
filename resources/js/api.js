import axios from "axios";

// Create an instance of axios if needed
const api = axios.create({
    baseURL: "/api/v1", // Set your base API URL here if needed
});

// Add a response interceptor
api.interceptors.response.use(
    function (response) {
        // If the request succeeds, just return the response
        return response;
    },
    function (error) {
        // If the error has a 401 status code
        if (error.response && error.response.status === 401) {
            const currentUrl =
                window.location.pathname + window.location.search;
            window.location.href = `/login?redirect=${encodeURIComponent(
                currentUrl
            )}`;
        }

        // Reject the promise with the error to allow further handling
        return Promise.reject(error);
    }
);

export default api;
