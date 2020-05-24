export default [
  {
    path: '/login',
    name: 'login',
    component: () => import('@Pages/Login')
  },

  {
    path: '/register',
    name: 'register',
    component: () => import('@Pages/Register')
  },

  {
    path: '/my/interviews',
    name: 'my-interviews',
    component: () => import('@Pages/My/Interviews/Index')
  },

  {
    path: '/my/interviews/:id',
    name: 'my-interviews-id',
    component: () => import('@Pages/My/Interviews/_Id/Index')
  }
]
