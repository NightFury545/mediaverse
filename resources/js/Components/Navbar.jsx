import React, { useState } from "react";
import { AppBar, Toolbar, Typography, Box, IconButton, Drawer, MenuItem } from "@mui/material";
import SearchIcon from "@mui/icons-material/Search";
import NotificationsIcon from "@mui/icons-material/Notifications";
import GitHubIcon from "@mui/icons-material/GitHub";
import MenuIcon from "@mui/icons-material/Menu";
import Search from "../Components/Search.jsx";

const Navbar = () => {
    const [openDrawer, setOpenDrawer] = useState(false);
    const [hoveredMenu, setHoveredMenu] = useState(null);
    const [hoveredSubMenu, setHoveredSubMenu] = useState(null);

    const toggleDrawer = () => setOpenDrawer(!openDrawer);
    const handleMenuHover = (menu) => setHoveredMenu(menu);
    const handleMenuLeave = () => setHoveredMenu(null);
    const handleSubMenuHover = (subMenu) => setHoveredSubMenu(subMenu);
    const handleSubMenuLeave = () => setHoveredSubMenu(null);

    const menuItemStyles = {
        paddingLeft: "15px",
        paddingRight: "15px",
        color: "rgba(255, 255, 255, 0.7)",
        "&:hover": { color: "#ffffff" },
    };

    const subMenuStyles = (hovered) => ({
        backgroundColor: hovered ? "#666" : "transparent",
        borderRadius: "4px",
        "&:hover": { backgroundColor: "#666" },
        paddingLeft: "15px",
        paddingRight: "15px",
    });

    const dropdownMenu = (menuName, items) => (
        <Box
            onMouseEnter={() => handleMenuHover(menuName)}
            onMouseLeave={handleMenuLeave}
            sx={{ position: "relative", color: "rgba(255, 255, 255, 0.7)", "&:hover": { color: "#ffffff" } }}
        >
            <MenuItem sx={menuItemStyles}>{menuName}</MenuItem>
            {hoveredMenu === menuName && (
                <Box
                    sx={{
                        position: "absolute",
                        top: "100%",
                        left: 0,
                        backgroundColor: "rgba(0, 0, 0, 0.9)",
                        color: "#ffffff",
                        boxShadow: "0px 4px 6px rgba(0, 0, 0, 0.1)",
                        borderRadius: "8px",
                        zIndex: 10,
                        opacity: hoveredMenu === menuName ? 1 : 0,
                        transition: "opacity 0.3s ease-in-out",
                    }}
                >
                    {items.map((item) => (
                        <MenuItem
                            key={item}
                            onMouseEnter={() => handleSubMenuHover(item)}
                            onMouseLeave={handleSubMenuLeave}
                            sx={subMenuStyles(hoveredSubMenu === item)}
                        >
                            {item}
                        </MenuItem>
                    ))}
                </Box>
            )}
        </Box>
    );

    return (
        <>
            <AppBar position="sticky" sx={{ background: "transparent", backdropFilter: "blur(8px)", boxShadow: "none", borderBottom: "0.3px solid rgba(255, 255, 255, 0.05)" }}>
                <Toolbar sx={{ display: "flex", justifyContent: "space-between", alignItems: "center" }}>
                    <Box sx={{ display: "flex", alignItems: "center", gap: 6 }}>
                        <Typography variant="h6" sx={{ color: "#ffffff", fontWeight: "bold", textAlign: { xs: "center", md: "left" } }}>
                            MediaVerse
                        </Typography>
                        <Box sx={{ display: { xs: "none", md: "flex" }, gap: 3, alignItems: "center", paddingTop: "3px" }}>
                            {dropdownMenu("Головна", [])}
                            {dropdownMenu("Мережа", ["Чати", "Пости", "Коментарі"])}
                            {dropdownMenu("Фільми", ["Новинки", "Популярне", "Жанри"])}
                        </Box>
                    </Box>
                    <Box sx={{ display: { xs: "none", md: "flex" }, alignItems: "center", gap: 2 }}>
                        <Search />
                        <IconButton sx={{ color: "#ffffff" }}><NotificationsIcon /></IconButton>
                        <IconButton sx={{ color: "#ffffff" }}><GitHubIcon /></IconButton>
                    </Box>
                    <IconButton sx={{ display: { xs: "block", md: "none" }, color: "#ffffff" }} edge="start" onClick={toggleDrawer}>
                        <MenuIcon />
                    </IconButton>
                </Toolbar>
            </AppBar>

            <Drawer anchor="left" open={openDrawer} onClose={toggleDrawer} sx={{ "& .MuiDrawer-paper": { backgroundColor: "rgba(28, 28, 28, 0.9)", color: "#ffffff" } }}>
                <Box sx={{ width: 250 }}>
                    <MenuItem onClick={toggleDrawer}>Головна</MenuItem>
                    <MenuItem onClick={toggleDrawer}>Мережа</MenuItem>
                    <MenuItem onClick={toggleDrawer}>Фільми</MenuItem>
                    <MenuItem onClick={toggleDrawer}>Форум</MenuItem>
                </Box>
            </Drawer>
        </>
    );
};

export default Navbar;
