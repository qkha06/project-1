<?php

return [
    [
        'title' => 'Dashboard',
        'url' => 'admin.dashboard.index',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg"width="24"height="24"viewBox="0 0 24 24"fill="none"stroke="currentColor"stroke-width="2"stroke-linecap="round"stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-dashboard"><path stroke="none"d="M0 0h24v24H0z"fill="none"/><path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/><path d="M13.45 11.55l2.05 -2.05"/><path d="M6.4 20a9 9 0 1 1 11.2 0z"/></svg>'
    ],
    [
        'title' => 'Thống kê truy cập',
        'url' => 'admin.access.index',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg"width="24"height="24"viewBox="0 0 24 24"fill="none"stroke="currentColor"stroke-width="2"stroke-linecap="round"stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-chart-bar"><path stroke="none"d="M0 0h24v24H0z"fill="none"></path><path d="M3 13a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path><path d="M15 9a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path><path d="M9 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path><path d="M4 20h14"></path></svg>'
    ],
    [
        'title' => 'Liên kết',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg"width="24"height="24"viewBox="0 0 24 24"fill="none"stroke="currentColor"stroke-width="2"stroke-linecap="round"stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-link"><path stroke="none"d="M0 0h24v24H0z"fill="none"></path><path d="M9 15l6 -6"></path><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"></path><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"></path></svg>',
        'children' => [
            [
                'title' => 'STULinks',
                'url' => 'admin.stu.index'
            ],
            [
                'title' => 'NOTELinks',
                'url' => 'admin.note.index'
            ]
        ]
    ],
    [
        'title' => 'Hoá đơn',
        'url' => 'admin.invoices.index',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg"width="24"height="24"viewBox="0 0 24 24"fill="none"stroke="currentColor"stroke-width="2"stroke-linecap="round"stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-invoice"><path stroke="none"d="M0 0h24v24H0z"fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M19 12v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-14a2 2 0 0 1 2 -2h7l5 5v4.25"></path></svg>'
    ],
    [
        'title' => 'Người dùng',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg"width="24"height="24"viewBox="0 0 24 24"fill="none"stroke="currentColor"stroke-width="2"stroke-linecap="round"stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none"d="M0 0h24v24H0z"fill="none"></path><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path><path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path></svg>',
        'children' => [
            [
                'title' => 'All Users',
                'url' => 'admin.users.index'
            ],
            [
                'title' => 'Create User',
                'url' => 'admin.users.create'
            ]
        ]
    ],
    [
        'title' => 'Phân quyền',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg"width="24"height="24"viewBox="0 0 24 24"fill="none"stroke="currentColor"stroke-width="2"stroke-linecap="round"stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-parking-circle"><path stroke="none"d="M0 0h24v24H0z"fill="none"></path><path d="M10 16v-8h3.334c.92 0 1.666 .895 1.666 2s-.746 2 -1.666 2h-3.334"></path><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path></svg>',
        'children' => [
            [
                'title' => 'Vai trò',
                'url' => 'admin.roles.index'
            ],
            [
                'title' => 'Quyền',
                'url' => 'admin.permissions.index'
            ]
        ]
    ],
    [
        'title' => 'Cấu hình',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg"width="24"height="24"viewBox="0 0 24 24"fill="none"stroke="currentColor"stroke-width="2"stroke-linecap="round"stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-settings-2"><path stroke="none"d="M0 0h24v24H0z"fill="none"></path><path d="M19.875 6.27a2.225 2.225 0 0 1 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z"></path><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path></svg>',
        'children' => [
            [
                'title' => 'Hệ thống',
                'url' => 'admin.general.index'
            ],
            [
                'title' => 'Cấp độ',
                'url' => 'admin.level.index'
            ],
            [
                'title' => 'P.Thức thanh toán',
                'url' => 'admin.payment-methods.index'
            ]
        ]
    ],
    [
        'title' => 'Blog',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg"width="24"height="24"viewBox="0 0 24 24"fill="none"stroke="currentColor"stroke-width="2"stroke-linecap="round"stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-article"><path stroke="none"d="M0 0h24v24H0z"fill="none"></path><path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path><path d="M7 8h10"></path><path d="M7 12h10"></path><path d="M7 16h10"></path></svg>',
        'children' => [
            [
                'title' => 'Category',
                'url' => 'admin.category.index'
            ],
            [
                'title' => 'Posts',
                'url' => 'admin.post.index'
            ]
        ]
    ],
    // Thêm các mục menu khác ở đây
];
