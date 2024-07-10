export let convertToFormdata = (obj:{[x:string]:any}) => {
    let formData = new FormData()
    Object.keys(obj).forEach(item=>{
        formData.append(item, typeof obj[item] === "object" || Array.isArray(obj[item]) ? JSON.stringify(obj[item]): obj[item])
    })
    return formData
}