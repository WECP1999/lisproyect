
/**
 * @name Globals
 * @description Generalidades globales de la aplicación.
 */
const Project = '/supadigital/public/';
const Devices = {
    LOGIN: 'login',
    ADMIN: 'dHome',
    MASTER: 'mHome',
    ALUMNO: 'aHome'
};
const Views = {
    LOGIN: 'login',
    ADMIN: {
        HOME: 'dHome',
        INSERT: {
            MATERIA: "dIngMateria",
            MAESTRO: "dIngMaestro",
            ALUMNO: "dIngAlumno",
            ASIGNACION: "dIngAsignacion"
        },
        UPDATE: {
            MATERIA: "dModificarMateria",
            MAESTRO: "dModificarMaestro",
            ALUMNO: "dModificarAlumno",
            ASIGNACION: "dModificarAsignacion"
        },
        SELECT: {
            MATERIA: "dVerMateria",
            MAESTRO: "dVerMaestro",
            ALUMNO: "dVerAlumno",
            ASIGNACION: "dVerAsignacion"
        }
    },
    MASTER: {
        HOME: 'mHome',
        INSERT:{
            ACTIVIDAD: "mIngActividad",
            NOTAS: "mIngNotas"
        },
        UPDATE:{},
        SELECT:{}
    },
    ALUMNO:{
        HOME: 'aHome',
        INSERT:{},
        UPDATE:{},
        SELECT:{}
    }
    
}
export { Project, Devices, Views };