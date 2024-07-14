const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"filepond-process":{"uri":"filepond","methods":["POST"]},"filepond-patch":{"uri":"filepond","methods":["PATCH"]},"filepond-head":{"uri":"filepond","methods":["GET","HEAD"]},"filepond-revert":{"uri":"filepond","methods":["DELETE"]},"dashboard":{"uri":"dashboard","methods":["GET","HEAD"]},"profile.update":{"uri":"profile\/update","methods":["POST"]},"profile.delete":{"uri":"profile\/delete","methods":["DELETE"]},"avatar.update":{"uri":"profile\/avatar","methods":["POST"]},"project.index":{"uri":"projects","methods":["GET","HEAD"]},"project.show":{"uri":"project\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"project.update":{"uri":"project\/{id}\/update","methods":["POST"],"parameters":["id"]},"project.store":{"uri":"project\/store","methods":["POST"]},"project.delete":{"uri":"project\/{id}","methods":["DELETE"],"parameters":["id"]},"contractor.index":{"uri":"contractors","methods":["GET","HEAD"]},"contractor.show":{"uri":"contractor\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"contractor.update":{"uri":"contractor\/{id}\/update","methods":["POST"],"parameters":["id"]},"contractor.store":{"uri":"contractor\/store","methods":["POST"]},"contractor.delete":{"uri":"contractor\/{id}","methods":["DELETE"],"parameters":["id"]},"contractor.api":{"uri":"contractor\/api","methods":["GET","HEAD"]},"team.index":{"uri":"teams","methods":["GET","HEAD"]},"team.update":{"uri":"team\/{id}\/update","methods":["POST"],"parameters":["id"]},"team.delete":{"uri":"team\/{id}","methods":["DELETE"],"parameters":["id"]},"team.api":{"uri":"team\/api","methods":["GET","HEAD"]},"project.details":{"uri":"project\/{id}\/details","methods":["GET","HEAD"],"parameters":["id"]},"project.milestones":{"uri":"project\/{id}\/milestones","methods":["GET","HEAD"],"parameters":["id"]},"project.files":{"uri":"project\/{id}\/files","methods":["GET","HEAD"],"parameters":["id"]},"project.status.change":{"uri":"project\/{id}\/status","methods":["PUT"],"parameters":["id"]},"project.assigned.update":{"uri":"project\/{id}\/assign","methods":["POST"],"parameters":["id"]},"file.store":{"uri":"file\/store","methods":["POST"]},"file.delete":{"uri":"file\/{id}","methods":["DELETE"],"parameters":["id"]},"files.delete":{"uri":"files","methods":["DELETE"]},"folder.update":{"uri":"folder\/update","methods":["POST"]},"folder.store":{"uri":"folder\/store","methods":["POST"]},"folder.delete":{"uri":"folder\/{id}","methods":["DELETE"],"parameters":["id"]},"milestone.update":{"uri":"milestone\/{id}\/update","methods":["POST"],"parameters":["id"]},"milestone.store":{"uri":"milestone\/store","methods":["POST"]},"milestone.delete":{"uri":"milestone\/{id}","methods":["DELETE"],"parameters":["id"]},"register":{"uri":"register","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"]},"password.email":{"uri":"forgot-password","methods":["POST"]},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"],"parameters":["token"]},"password.store":{"uri":"reset-password","methods":["POST"]},"verification.notice":{"uri":"verify-email","methods":["GET","HEAD"]},"verification.verify":{"uri":"verify-email\/{id}\/{hash}","methods":["GET","HEAD"],"parameters":["id","hash"]},"verification.send":{"uri":"email\/verification-notification","methods":["POST"]},"password.confirm":{"uri":"confirm-password","methods":["GET","HEAD"]},"password.update":{"uri":"password","methods":["PUT"]},"logout":{"uri":"logout","methods":["POST"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
