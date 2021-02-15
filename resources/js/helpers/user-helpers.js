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
        view: 10,
        other: 0
    }

    return roles[userRole] >= roles[acceptedRole]
}

export default {
    hasAccess
}
