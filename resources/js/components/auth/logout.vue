<template>

</template>

<script>
export default {
    name: "logout",
    created(){
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        Toast.fire({
            icon: 'success',
            title: 'Deconnexion avec succès'
        })
        this.$router.push({name: '/'})
    }
}
</script>

<style scoped>

</style>
