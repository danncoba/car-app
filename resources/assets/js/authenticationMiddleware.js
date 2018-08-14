export default class Auth {
    static isAllowed(success, error) {
        $.ajax({
            method: 'GET',
            url: '/api/user',
            success: function(response) {
                if (response.id !== undefined) {
                    success(response)
                } else {
                    error("not logged in");
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
                next()
            } else {
                next({ path: '/login' });
            }

        }, (err) => {
            next({ path: '/login' })
        })
    }
}