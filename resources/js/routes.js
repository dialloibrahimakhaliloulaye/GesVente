//import login from "./components/auth/login";

let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;
// End authentication
let home = require('./components/home.vue').default;

// Employee component
let storeemployee = require('./components/employee/create.vue').default;
let employee = require('./components/employee/index.vue').default;
let editemployee = require('./components/employee/edit.vue').default;

// Supplier Component
let storesuplier = require('./components/suplier/create.vue').default;
let suplier = require('./components/suplier/index.vue').default;
let editsuplier = require('./components/suplier/edit.vue').default;

// Category Component
let storecategory = require('./components/category/create.vue').default;
let category = require('./components/category/index.vue').default;
let editcategory = require('./components/category/edit.vue').default;

export const routes = [
    { path: '/', component: login, name: '/' },
    { path: '/register', component: register, name: 'register' },
    { path: '/forget', component: forget, name: 'forget' },
    { path: '/logout', component: logout, name: 'logout' },
    { path: '/home', component: home, name: 'home' },

    // Employee Routes
    { path: '/store-employee', component: storeemployee, name: 'store-employee' },
    { path: '/employee', component: employee, name: 'employee' },
    { path: '/edit-employee/:id', component: editemployee, name:'edit-employee'},

    // Supplier Routes
    { path: '/store-suplier', component: storesuplier, name:'store-suplier'},
    { path: '/suplier', component: suplier, name:'suplier'},
    { path: '/edit-suplier/:id', component: editsuplier, name:'edit-suplier'},

    // Category Routes
    { path: '/store-category', component: storecategory, name:'store-category'},
    { path: '/category', component: category, name:'category'},
    { path: '/edit-category/:id', component: editcategory, name:'edit-category'},
]
