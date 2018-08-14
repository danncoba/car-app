export default class Auth {
    static isAllowed(success, error) {
        $.ajax({
            method: 'GET',
            url: '/api/user',
            success: function(response) {
                Laravel.csrfToken = response.token
                if (response.user !== null) {
                    if (response.user.id !== undefined) {
                        success(response.user)
                    } else {
                        error("not logged in");
                    }
                } else {
                    error("not logged in")
                }
            },
            error: function(err) {
                error(err);
            }
        });
    }

    isCurrentAllowedAdmin(to, from, next) {
        Auth.isAllowed((resp) => {
            if (resp.type === 'admin') {
                Event.vue.$emit('navigationUpdated', { type: 'admin' })
                next()
            } else {
                next({ path: '/login' });
            }
        }, (err) => {
            next({ path: '/login' })
        })
    }

    isCurrentAllowedMember(to, from, next) {
        Auth.isAllowed((resp) => {
            if (resp.type === 'member') {
                Event.vue.$emit('navigationUpdated', { type: 'member' })
                next()
            } else {
                next({ path: '/login' });
            }

        }, (err) => {
            next({ path: '/login' })
        })
    }

    notAuthRoute(to, from, next) {
        Auth.isAllowed((resp) => {
            if (resp.type === 'admin') {
                Event.vue.$emit('navigationUpdated', { type: 'admin' })
                next()
            } else if (resp.type === 'member') {
                Event.vue.$emit('navigationUpdated', { type: 'member' })
                next()
            } else {
                Event.vue.$emit('navigationUpdated', { type: 'ordinary' });
                next()
            }
        }, (err) => {
            Event.vue.$emit('navigationUpdated', { type: 'ordinary' });
            next()
        });
    }
}