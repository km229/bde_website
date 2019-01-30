// Imports
var jwt = require('jsonwebtoken');

const JWT_SIGN_SECRET = 'abvirbiuvbuibvyuezbnvuiezbvubziuvbziybvyuzbvuizyvviuvbzuvbziuybviuzyuibzuv62121v5ze1v5z1v6z1269v1z92vz2v5z1v';

// Exported functions
module.exports = {
    generateTokenForUser: function(userData) {
        return jwt.sign({
            member_id: '1',
            is_admin: '1'
        },
        JWT_SIGN_SECRET,
        {
            expiresIn: '1h'
        })
    },
}