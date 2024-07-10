export const fDate = (dt: string | number | Date)=> {
    return new Date(dt).toLocaleDateString('en-NG')
}