import { configureStore, createSlice } from "@reduxjs/toolkit";

// Simple auth slice for initial setup and state management
const authSlice = createSlice({
    name: "auth",
    initialState: {
        user: null,
        isAuthenticated: false,
        token: null
    },
    reducers: {
        setCredentials(state, action) {
            state.user = action.payload.user;
            state.token = action.payload.token;
            state.isAuthenticated = true;
        },
        clearCredentials(state) {
            state.user = null;
            state.token = null;
            state.isAuthenticated = false;
        }
    }
});

export const { setCredentials, clearCredentials } = authSlice.actions;

const store = configureStore({
    reducer: {
        auth: authSlice.reducer
    },
    middleware: (getDefaultMiddleware) =>
        getDefaultMiddleware({
            serializableCheck: false
        })
});

export default store;
