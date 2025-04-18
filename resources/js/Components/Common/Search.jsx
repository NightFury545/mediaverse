import React, { useState } from "react";
import { Box, Button, IconButton, Modal, TextField, Typography } from "@mui/material";
import SearchIcon from "@mui/icons-material/Search";
import CloseIcon from "@mui/icons-material/Close";

const Search = ({ isMobile }) => {
    const [open, setOpen] = useState(false);
    const handleOpen = () => setOpen(true);
    const handleClose = () => setOpen(false);

    return (
        <>
            {/* Кнопка для відкриття пошуку */}
            <Button
                onClick={handleOpen}
                sx={{
                    backgroundColor: "#1b1222", // Фон кнопки
                    color: "#d3d3d3", // Текст кнопки
                    textTransform: "none",
                    fontSize: "14px",
                    display: "flex",
                    alignItems: "center",
                    justifyContent: isMobile ? "center" : "flex-start", // Іконка по центру на мобільних пристроях
                    gap: isMobile ? "0" : "8px", // Прибрати проміжок між іконкою та текстом на мобільних
                    borderRadius: "6px", // Менш округлі краї
                    border: "1px solid #333", // Темний бордер
                    padding: isMobile ? "0" : "6px 12px", // Відсутність відступів для квадратної кнопки на мобільних
                    width: isMobile ? "42px" : "180px", // Зменшена ширина для мобільних
                    height: isMobile ? "36px" : "auto", // Зменшена висота для мобільних
                    minWidth: "36px",
                    transition: "width 0.15s ease", // Швидке розтягнення по ширині
                    transformOrigin: "100% center", // Точка опори справа
                    '&:hover': {
                        backgroundColor: "#2a1b33", // Ховер-ефект
                        width: isMobile ? "42px" : "220px", // Збільшення ширини для мобільних
                    },
                }}
            >
                <SearchIcon sx={{ fontSize: 16 }} />
                {!isMobile && (
                    <Typography sx={{ fontSize: "14px", fontWeight: "normal" }}>
                        Пошук...
                    </Typography>
                )}
            </Button>

            {/* Модальне вікно для панелі пошуку */}
            <Modal open={open} onClose={handleClose}>
                <Box
                    sx={{
                        position: "fixed",
                        top: "50%",
                        left: "50%",
                        transform: "translate(-50%, -50%)",
                        width: "90%", // Адаптивна ширина
                        maxWidth: "600px", // Максимальна ширина
                        backgroundColor: "#000", // Чорний фон
                        borderRadius: "10px",
                        border: "1px solid #444", // Темно-сірий бордер
                        boxShadow: "0px 8px 24px rgba(0, 0, 0, 0.6)", // Тінь
                        p: 3,
                        color: "#d3d3d3", // Приглушений текст
                    }}
                >
                    {/* Верхня панель з кнопкою закриття */}
                    <Box
                        sx={{
                            display: "flex",
                            justifyContent: "space-between",
                            alignItems: "center",
                            mb: 2,
                        }}
                    >
                        <Typography variant="h6" sx={{ color: "#d3d3d3", fontWeight: 500 }}>
                            Пошук
                        </Typography>
                        <IconButton onClick={handleClose} sx={{ color: "#d3d3d3" }}>
                            <CloseIcon sx={{ fontSize: 22 }} />
                        </IconButton>
                    </Box>

                    {/* Поле для пошуку */}
                    <TextField
                        fullWidth
                        placeholder="Пошук..."
                        variant="outlined"
                        autoFocus
                        InputProps={{
                            style: {
                                color: "#d3d3d3", // Приглушений текст
                                fontSize: "14px",
                            },
                            endAdornment: (
                                <IconButton sx={{ color: "#d3d3d3" }}>
                                    <SearchIcon sx={{ fontSize: 20 }} />
                                </IconButton>
                            ),
                        }}
                        sx={{
                            "& .MuiOutlinedInput-root": {
                                backgroundColor: "#111", // Темний фон поля
                                borderRadius: "8px",
                                "& fieldset": {
                                    borderColor: "#444",
                                },
                                "&:hover fieldset": {
                                    borderColor: "#666",
                                },
                                "&.Mui-focused fieldset": {
                                    borderColor: "#aaa",
                                },
                            },
                        }}
                    />
                </Box>
            </Modal>
        </>
    );
};

export default Search;
