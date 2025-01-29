import React from "react";
import Navbar from "../Components/Navbar.jsx";
import { Box, Typography, Card, CardContent, Grid, Container } from "@mui/material";
import { motion } from "framer-motion";

const Home = () => {
    const features = [
        { title: "Фільми", description: "Дивіться найкращі фільми у зручному форматі.", icon: "🎥" },
        { title: "Музика", description: "Слухайте популярну музику у будь-який час.", icon: "🎵" },
        { title: "Книги", description: "Читайте улюблені книги онлайн.", icon: "📚" },
        { title: "Чати", description: "Спілкуйтесь із друзями прямо на платформі.", icon: "💬" },
    ];

    const fadeInVariant = {
        hidden: { opacity: 0, y: 50 },
        visible: { opacity: 1, y: 0, transition: { duration: 0.6 } },
    };

    return (
        <>
            <Navbar />
            <Box
                sx={{
                    display: "flex",
                    justifyContent: "space-between",
                    alignItems: "center",
                    flexWrap: "wrap",
                    py: 4, // зменшено padding по вертикалі
                    px: { xs: 2, md: 6 },
                    minHeight: "80vh", // зменшено мінімальну висоту
                }}
            >
                {/* Ліва частина */}
                <Box
                    component={motion.div}
                    initial="hidden"
                    animate="visible"
                    variants={fadeInVariant}
                    sx={{
                        flex: 1,
                        maxWidth: { xs: "100%", md: "600px" },
                        padding: { xs: 2, md: 4 },
                        textAlign: "left",
                        order: { xs: 2, md: 1 },
                        marginTop: { xs: 4, md: 0 },
                        marginRight: { xs: 0, md: 4 },
                    }}
                >
                    <Typography
                        variant="h3"
                        sx={{
                            fontWeight: "bold",
                            mb: 3,
                            color: "#ffffff",
                            fontSize: { xs: "2.5rem", md: "3.5rem" },
                        }}
                    >
                        Вітаємо у MediaVerse
                    </Typography>
                    <Typography
                        variant="body1"
                        sx={{
                            lineHeight: 1.8,
                            color: "rgba(255, 255, 255, 0.8)",
                            fontSize: { xs: "1rem", md: "1.2rem" },
                        }}
                    >
                        Відкрийте для себе світ фільмів, музики, книг та багато іншого. Тут усе, що вам
                        потрібно, в одному місці.
                    </Typography>
                </Box>

                {/* Права частина */}
                <Box
                    component={motion.div}
                    initial="hidden"
                    animate="visible"
                    variants={fadeInVariant}
                    sx={{
                        flex: 1,
                        maxWidth: { xs: "100%", md: "500px" },
                        mt: { xs: 4, md: 0 },
                        display: "flex",
                        justifyContent: "center",
                        order: { xs: 1, md: 2 },
                    }}
                >
                    <img
                        src="https://via.placeholder.com/500x400?text=MediaVerse"
                        alt="MediaVerse"
                        style={{ maxWidth: "100%", borderRadius: "20px" }}
                    />
                </Box>
            </Box>

            {/* Секція з картками */}
            <Container sx={{ py: 6 }}>
                <Typography
                    component={motion.div}
                    initial="hidden"
                    whileInView="visible"
                    viewport={{ once: true }}
                    variants={fadeInVariant}
                    variant="h4"
                    sx={{
                        textAlign: "center",
                        mb: 4,
                        fontWeight: "bold",
                    }}
                >
                    Що ми пропонуємо
                </Typography>

                <Grid container spacing={4}>
                    {features.map((feature, index) => (
                        <Grid item xs={12} sm={6} md={3} key={index}>
                            <Card
                                component={motion.div}
                                initial="hidden"
                                whileInView="visible"
                                viewport={{ once: true }}
                                variants={fadeInVariant}
                                sx={{
                                    background: "rgba(255, 255, 255, 0.1)",
                                    color: "#ffffff",
                                    borderRadius: "15px",
                                }}
                            >
                                <CardContent>
                                    <Typography
                                        variant="h5"
                                        sx={{
                                            textAlign: "center",
                                            mb: 2,
                                        }}
                                    >
                                        {feature.icon}
                                    </Typography>
                                    <Typography
                                        variant="h6"
                                        sx={{
                                            textAlign: "center",
                                            fontWeight: "bold",
                                            mb: 1,
                                        }}
                                    >
                                        {feature.title}
                                    </Typography>
                                    <Typography
                                        variant="body2"
                                        sx={{
                                            textAlign: "center",
                                            color: "rgba(255, 255, 255, 0.7)",
                                        }}
                                    >
                                        {feature.description}
                                    </Typography>
                                </CardContent>
                            </Card>
                        </Grid>
                    ))}
                </Grid>
            </Container>
        </>
    );
};

export default Home;
