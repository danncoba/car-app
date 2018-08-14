<template>
    <ul class="nav-menu">
        <li v-for="nav in navValues">
            <router-link :to="nav.path">{{nav.name}}</router-link>
        </li>
    </ul>
</template>


<script>
const DEFAULT_NAV = [{
    path: '/',
    name: 'Home'
}, {
    path: '/login',
    name: 'Login'
}];

const ADMIN_NAV = [{
    path: '/',
    name: 'Home'
}, {
    path: '/dashboard',
    name: 'Dashboard'
}, {
    path: '/logout',
    name: "Logout"
}]

const MEMBER_NAV = [{
    path: '/',
    name: 'Home'
}, {
    path: '/dashboard-member',
    name: 'Dashboard'
}, {
    path: '/logout',
    name: "Logout"
}]

export default {
    name: 'MainNav',
    data: function(){
        return{
            // Default nav values depending on the user type or is user logged in
            navValues: DEFAULT_NAV
        }
    },

    mounted() {
        let self = this
        Event.vue.$on('navigationUpdated', (type) => {
            if(type.type === 'admin'){
                self.navValues = ADMIN_NAV
            }else if(type.type === 'member') {
                self.navValues = MEMBER_NAV
            }else {
                self.navValues = DEFAULT_NAV
            }
        });
    }
}
</script>
