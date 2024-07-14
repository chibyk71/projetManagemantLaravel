export const removeLeadingAsterisk = (str: string) => {
    
    if (str.startsWith('*')) {
        console.log();
        
        return str.slice(1);
    }
    return str;
};