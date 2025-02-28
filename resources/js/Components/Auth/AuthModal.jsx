import React, { useState } from "react";
import {
    Box,
    Button,
    Fade,
    FormHelperText,
    Grid,
    IconButton,
    Modal,
    TextField,
    Typography,
    useMediaQuery,
    useTheme
} from "@mui/material";
import { Close, GitHub, Google } from "@mui/icons-material";
import { Field, Form, Formik } from "formik";
import * as Yup from "yup";
import "../../../css/signIn.css";

const validationSchema = Yup.object({
    username: Yup.string().when('isSignUp', {
        is: true,
        then: Yup.string().required("Обов'язкове поле"),
    }),
    email: Yup.string().email("Невірний формат емейлу").required("Обов'язкове поле"),
    password: Yup.string().min(8, "Не менше 8 символів").required("Обов'язкове поле"),
});

const AuthModal = ({ open, handleClose, isSignUp = false }) => {
    const theme = useTheme();
    const isMobile = useMediaQuery(theme.breakpoints.down("sm"));
    const [isSignIn, setIsSignIn] = useState(!isSignUp);

    const toggleForm = (resetForm) => {
        resetForm();
        setIsSignIn(prev => !prev);
    };

    return (
        <Modal
            open={open}
            onClose={handleClose}
            closeAfterTransition
            BackdropProps={{
                style: {
                    backgroundColor: "rgba(0, 0, 0, 0.8)",
                    backdropFilter: "blur(10px)",
                },
            }}
        >
            <Fade in={open}>
                <Box
                    sx={{
                        display: "flex",
                        justifyContent: "center",
                        alignItems: "center",
                        minHeight: "100vh",
                    }}
                >
                    <Box
                        sx={{
                            display: "flex",
                            backgroundColor: "#000",
                            padding: 3,
                            borderRadius: 2,
                            width: "90%",
                            maxWidth: 765,
                            boxShadow: 24,
                            textAlign: "center",
                            position: "relative",
                            flexDirection: isMobile ? "column" : "row",
                            color: "#fff",
                            maxHeight: "600px",
                            overflowY: "auto",
                            "&::-webkit-scrollbar": {
                                display: "hidden",
                            },
                            "-ms-overflow-style": "hidden",
                            "scrollbar-width": "hidden",
                        }}
                    >
                        {/* Зображення зліва, якщо не мобільна версія */}
                        {!isMobile && (
                            <Box
                                sx={{
                                    backgroundImage: 'url("/storage/images/signIn-background.jpg")',
                                    backgroundSize: "cover",
                                    backgroundPosition: "center",
                                    borderRadius: 2,
                                    flex: 1,
                                    aspectRatio: "16 / 9",
                                }}
                            />
                        )}

                        <Box
                            sx={{
                                flex: 1,
                                padding: 3,
                                borderRadius: 2,
                                textAlign: "center",
                            }}
                        >
                            {/* Кнопка закриття модалки */}
                            <IconButton
                                onClick={handleClose}
                                sx={{
                                    position: "absolute",
                                    top: 16,
                                    right: 16,
                                    color: "#fff",
                                }}
                            >
                                <Close />
                            </IconButton>

                            <Typography variant="h5" sx={{ fontWeight: 600, color: "#fff", mb: 2 }}>
                                MediaVerse
                            </Typography>
                            <Typography variant="body2" sx={{ color: "#bbb", mb: 2 }}>
                                {isSignIn
                                    ? "Будь ласка, увійдіть, щоб продовжити."
                                    : "Будь ласка, зареєструйтесь, щоб продовжити."}
                            </Typography>

                            <Formik
                                initialValues={{ username: "", email: "", password: "" }}
                                validationSchema={validationSchema}
                                onSubmit={(values) => console.log(values)}
                            >
                                {({ errors, touched, resetForm }) => (
                                    <Form>
                                        <Grid container direction="column" spacing={1}>
                                            {/* Поле username для реєстрації */}
                                            {!isSignIn && (
                                                <Grid item>
                                                    <Field
                                                        as={TextField}
                                                        label="Username"
                                                        fullWidth
                                                        name="username"
                                                        error={touched.username && Boolean(errors.username)}
                                                        variant="outlined"
                                                        margin="dense"
                                                        sx={{
                                                            input: { color: "#fff" },
                                                            label: { color: "#bbb" },
                                                            backgroundColor: "#0c0c0d",
                                                            borderRadius: "7px",
                                                            "& .MuiOutlinedInput-root": {
                                                                "& fieldset": {
                                                                    borderColor: "#1d1d1e",
                                                                    borderRadius: "7px",
                                                                },
                                                                "&:hover fieldset": {
                                                                    borderColor: "#4b0505",
                                                                },
                                                            },
                                                        }}
                                                    />
                                                    {touched.username && errors.username && (
                                                        <FormHelperText sx={{ color: "#f44336", textAlign: "left" }}>
                                                            {errors.username}
                                                        </FormHelperText>
                                                    )}
                                                </Grid>
                                            )}

                                            {/* Поле email */}
                                            <Grid item>
                                                <Field
                                                    as={TextField}
                                                    label="Email"
                                                    fullWidth
                                                    name="email"
                                                    type="email"
                                                    error={touched.email && Boolean(errors.email)}
                                                    variant="outlined"
                                                    margin="dense"
                                                    sx={{
                                                        input: { color: "#fff" },
                                                        label: { color: "#bbb" },
                                                        backgroundColor: "#0c0c0d",
                                                        borderRadius: "7px",
                                                        "& .MuiOutlinedInput-root": {
                                                            "& fieldset": {
                                                                borderColor: "#1d1d1e",
                                                                borderRadius: "7px",
                                                            },
                                                            "&:hover fieldset": {
                                                                borderColor: "#4b0505",
                                                            },
                                                        },
                                                    }}
                                                />
                                                {touched.email && errors.email && (
                                                    <FormHelperText sx={{ color: "#f44336", textAlign: "left" }}>
                                                        {errors.email}
                                                    </FormHelperText>
                                                )}
                                            </Grid>

                                            {/* Поле password */}
                                            <Grid item>
                                                <Field
                                                    as={TextField}
                                                    label="Password"
                                                    type="password"
                                                    fullWidth
                                                    name="password"
                                                    error={touched.password && Boolean(errors.password)}
                                                    variant="outlined"
                                                    margin="dense"
                                                    sx={{
                                                        input: { color: "#fff" },
                                                        label: { color: "#bbb" },
                                                        backgroundColor: "#0c0c0d",
                                                        borderRadius: "7px",
                                                        "& .MuiOutlinedInput-root": {
                                                            "& fieldset": {
                                                                borderColor: "#1d1d1e",
                                                                borderRadius: "7px",
                                                            },
                                                            "&:hover fieldset": {
                                                                borderColor: "#4b0505",
                                                            },
                                                        },
                                                    }}
                                                />
                                                {touched.password && errors.password && (
                                                    <FormHelperText sx={{ color: "#f44336", textAlign: "left" }}>
                                                        {errors.password}
                                                    </FormHelperText>
                                                )}
                                            </Grid>

                                            {/* Кнопка submit */}
                                            <Grid item>
                                                <Button
                                                    type="submit"
                                                    variant="contained"
                                                    color="primary"
                                                    fullWidth
                                                    sx={{
                                                        py: 1,
                                                        mt: 1,
                                                        backgroundColor: "#ff4081",
                                                        "&:hover": {
                                                            backgroundColor: "#e60073",
                                                        },
                                                    }}
                                                >
                                                    {isSignIn ? "Увійти" : "Зареєструватися"}
                                                </Button>
                                            </Grid>

                                            {/* Кнопка перемикання форми */}
                                            <Grid item>
                                                <Button
                                                    variant="outlined"
                                                    fullWidth
                                                    sx={{
                                                        py: 1,
                                                        mt: 1,
                                                        borderColor: "#ff4081",
                                                        color: "#ff4081",
                                                        "&:hover": {
                                                            borderColor: "#e60073",
                                                            color: "#e60073",
                                                        },
                                                    }}
                                                    onClick={() => toggleForm(resetForm)}
                                                >
                                                    {isSignIn ? "Реєстрація" : "Увійти"}
                                                </Button>
                                            </Grid>

                                            {/* Кнопки для Google та GitHub */}
                                            <Grid item>
                                                <Button
                                                    variant="contained"
                                                    color="error"
                                                    fullWidth
                                                    sx={{
                                                        py: 1,
                                                        mt: 1,
                                                        backgroundColor: "#db4437",
                                                        "&:hover": {
                                                            backgroundColor: "#c1351d",
                                                        },
                                                    }}
                                                    startIcon={<Google />}
                                                >
                                                    Увійти з Google
                                                </Button>
                                            </Grid>

                                            <Grid item>
                                                <Button
                                                    variant="contained"
                                                    color="secondary"
                                                    fullWidth
                                                    sx={{
                                                        py: 1,
                                                        mt: 1,
                                                        backgroundColor: "#24292f",
                                                        "&:hover": {
                                                            backgroundColor: "#181a1b",
                                                        },
                                                    }}
                                                    startIcon={<GitHub />}
                                                >
                                                    Увійти з GitHub
                                                </Button>
                                            </Grid>
                                        </Grid>
                                    </Form>
                                )}
                            </Formik>
                        </Box>
                    </Box>
                </Box>
            </Fade>
        </Modal>
    );
};

export default AuthModal;
