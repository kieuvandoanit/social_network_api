const user = [
    {
        path: "/",
        component: () => import("../layouts/user.vue"),
        children: [
            {
                path: "news",
                name: "news",
                // component: () => import("../pages/admin/users/index.vue")
            }
        ]
    }
];

export default user;
