import { z } from "zod";

export const userSchema = z.object({
    name: z.string().min(1),
    email: z.string().email().min(1),
    phone: z.string().transform((val,ctx) => {
        if (val.length < 10) {
            ctx.addIssue({ code: z.ZodIssueCode.custom, message: "phone number must be atleast 10 characters long" });
            return z.NEVER
        }
        if (isNaN(Number(val))) {
            ctx.addIssue({ code: z.ZodIssueCode.custom, message: "phone number must a number" });
            return z.NEVER
        }
        return val
    }),
    role: z.string().min(1).transform((val,ctx)=>{
        if (val.toLowerCase() != 'admin' && val.toLowerCase() != 'moderator') { 
            ctx.addIssue({ code: z.ZodIssueCode.custom, message: `role-(${val}) has to be either 'Admin' or 'Moderator'`,path:['password'] });
            return z.NEVER
        }
        return val.toUpperCase()
    })
})

export const passWordSchema =  z.object({
    oldpassword: z.string().min(6),
    password: z.string().min(6),
    confirm: z.string().min(6),
}).superRefine(({password,confirm},ctx)=>{
    if (confirm !== password) {
        ctx.addIssue({
          code: "custom",
          message: "The passwords did not match",
        });
      }
})

export const resetPassword = z.object({
    password: z.string().min(6),
    confirm: z.string().min(6),
}).superRefine(({password,confirm},ctx)=>{
    if (confirm !== password) {
        ctx.addIssue({
          code: "custom",
          message: "The passwords did not match",
        });
      }
})

export const updateAssigned = z.object({
    assigned: z.string().array().nullable()
})

export const projectsSchema = z.object({
    title: z.string().min(6),
    contractor: z.string().min(1),
    start_date: z.string(),
    due_date: z.string(),
    desc: z.string(),
    progress: z.number().max(100).min(0),
    assigned: z.string().array().optional(),
    number: z.string().optional(),
    contract_sum:  z.string(),
    date_of_award: z.string(),
    duration: z.string()
})

export const contractorSchema = z.object({
    name: z.string().min(6),
    email : z.string().email().optional(),
    url: z.string().url().optional(),
    // phone: z.string().min(10).max(11),
})

export const milestone = z.object({
    name: z.string(),
    status: z.enum(['IN_PROGRESS','YET_TO_COMMENCE','COMPLETED']),
    progress:   z.number(),
    contractor: z.string(),
})

export const loginSchema = z.object({
    email: z.string().email().min(1),
    password: z.string().min(6)
})
export type changePasswordSchema = typeof passWordSchema
export type newCreateProject = typeof projectsSchema