Proyecto actualmente abandonado. Disculpen las molestias

---

# OpenPortal

## The gate to the cloud experience

**Autor:** Ernesto Galindo Seijas  
**Institución:** I.E.S. Iliberis - 2ºASIR

---

## Índice

1. [Estudio del problema](#estudio-del-problema)
2. [Introducción](#introduccion)
3. [Objetivos](#objetivos)
4. [Planteamiento y evaluación de diversas soluciones](#planteamiento-y-evaluacion-de-diversas-soluciones)
5. [Justificación de la solución elegida](#justificacion-de-la-solucion-elegida)
6. [Modelado de la solución](#modelado-de-la-solucion)
7. [Planificación temporal](#planificacion-temporal)
8. [Documentación técnica](#documentacion-tecnica)
9. [Fase de pruebas](#fase-de-pruebas)
10. [Documentación del sistema](#documentacion-del-sistema)
11. [Conclusiones finales](#conclusiones-finales)
12. [Modificaciones o ampliaciones futuras](#modificaciones-o-ampliaciones-futuras)
13. [Bibliografía](#bibliografia)

---

## Estudio del problema

Actualmente existen muchas plataformas de juegos en la nube, pero la mayoría están enfocadas en juegos de grandes compañías. OpenPortal busca ser una alternativa accesible para juegos indies o de bajo presupuesto sin necesidad de hardware potente.

## Introducción

PortalGame es una plataforma de streaming de videojuegos en la nube pensada para desarrolladores independientes. Permite jugar sin necesidad de descargar archivos y facilita la distribución de demos para testing.

## Objetivos

Crear una plataforma de juegos en la nube escalable y segura que permita a los usuarios jugar sin hardware potente y a los desarrolladores gestionar sus juegos de manera sencilla.

## Planteamiento y evaluación de diversas soluciones

Se evaluaron distintas tecnologías para la plataforma:

- **WebSocket**: Baja latencia, pero requiere alto conocimiento técnico.
- **Nice DCV**: Solución de Amazon AWS, pero con documentación limitada.
- **Moonlight**: Servidor de juegos en la nube de NVIDIA, pero requiere extensiones de navegador.
- **Myrtille**: Convierte RDP en HTML5, permite integración con la URL.

## Justificación de la solución elegida

Se seleccionó **Myrtille** por su flexibilidad y capacidad de integrarse sin necesidad de software adicional del lado del usuario.

## Modelado de la solución

### Recursos humanos

- Gerente de Proyecto
- Arquitecto de Software
- Diseñador UI
- Desarrolladores Backend y Frontend
- Administrador de Base de Datos
- Especialista en Seguridad
- Tester

### Infraestructura

- **Servidor de Base de Datos**: MongoDB en Debian 12.
- **Servidor FTP**: Vsftpd en Debian 12.
- **Servidor Web**: Nginx, PHP, Docker, Minikube.
- **Servidor de Juegos**: Windows Server 2022 con Myrtille y RDP.

## Planificación temporal

1. **Investigación**: 6 semanas.
2. **Topología**: 2 semanas.
3. **Configuración del servidor**: 1 semana.
4. **Configuración del cliente**: 1 semana.
5. **Implementación de mejoras**: Tiempo restante hasta la entrega.

## Documentación técnica

### Servidor de Base de Datos

- Accesible solo desde la subnet privada.
- Se accede con `mongosh mongodb://portalgameUser@localhost:27017/portalgame`.

### Servidor Web

- Implementado en Docker con certificados en el puerto 443.
- Código en GitHub: [Repositorio](https://github.com/ErnesGS/PortalGame/tree/master)

### Servidor de Juegos

- Gestión de usuarios mediante Active Directory.
- Configuración de políticas de grupo (GPOs) para ejecución automática de juegos.

## Fase de pruebas

Se realizaron pruebas de seguridad y conectividad en los distintos servidores para garantizar el correcto funcionamiento de la plataforma.

## Documentación del sistema

### Manual de instalación

No requiere instalación, solo un navegador compatible. Se accede desde:

[portal-game.duckdns.org](http://portal-game.duckdns.org)

### Manual de usuario

1. Iniciar sesión o registrarse.
2. Seleccionar un juego.
3. La plataforma asigna un usuario disponible y se inicia el juego.

### Manual de administración

- Registro y modificación de clientes y juegos.
- Consulta y gestión de la base de datos.

## Conclusiones finales

OpenPortal es una solución escalable para juegos en la nube que ofrece facilidad de uso para jugadores y desarrolladores. Se prevé mejorar la seguridad y la experiencia del usuario en futuras versiones.

## Modificaciones o ampliaciones futuras

- Autenticación en dos pasos.
- Buscador de juegos y comentarios.
- Herramientas avanzadas para administradores.
- Implementación completa de Kubernetes.

## Bibliografía

- [AWS NICE DCV](https://aws.amazon.com/es/hpc/dcv/)
- [Moonlight Game Streaming](https://github.com/moonlight-stream)
- [Myrtille en GitHub](https://github.com/cedrozor/myrtille)
- [MongoDB Manual](https://www.mongodb.com/docs/manual/tutorial/install-mongodb-on-debian/)
- [PHP MongoDB](https://www.php.net/manual/es/set.mongodb.php)
- [CertBot](https://certbot.eff.org/instructions)

---

Si le interesa buscar una documentación más detallada es libre de mirar el archivo .pdf en el repositorio del proyecto
