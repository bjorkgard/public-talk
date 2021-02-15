/**
 * Compare if user role is higher or same as accepted role
 *
 * @param acceptedRole string
 * @param userRole string
 *
 * @returns boolean
 */
const hasAccess = (acceptedRole, userRole) => {
    const roles = {
        owner: 30,
        admin: 20,
        booker: 10,
        view: 0,
        other: -1
    }

    return roles[userRole] >= roles[acceptedRole]
}

export default {
    hasAccess
}
