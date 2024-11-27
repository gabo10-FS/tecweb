<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html" encoding="UTF-8" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/strict.dtd"/>

    <xsl:template match="/">
        <html>
            <head>
                <title>Catálogo VOD</title>
                <style type="text/css">
                    body {
                        font-family: 'Arial', sans-serif;
                        background-color: #f4f4f4;
                        margin: 0;
                        padding: 0;
                        color: #333;
                    }

                    header {
                        background-color: #2d6a4f;  
                        color: white;
                        padding: 20px 0;
                        text-align: center;
                    }

                    header img {
                        max-width: 100%;
                        height: auto;
                    }

                    .container {
                        width: 80%;
                        margin: 30px auto;
                        background-color: white;
                        padding: 30px;
                        border-radius: 10px;
                        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                    }

                    h1, h2 {
                        color: #2d6a4f;
                        font-size: 1.8em;
                    }

                    h2 {
                        margin-top: 20px;
                        font-size: 1.5em;
                    }

                    table {
                        width: 100%;
                        margin-bottom: 30px;
                        border-collapse: collapse;
                    }

                    th, td {
                        padding: 12px;
                        text-align: left;
                        border: 1px solid #ddd;
                    }

                    th {
                        background-color: #5a8f7d;  
                        color: white;
                        text-align: center;
                    }

                    tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }

                    tr:hover {
                        background-color: #e0f7e3; 
                    }

                    td span {
                        font-weight: bold;
                        color: #2d6a4f;
                    }

                </style>
            </head>
            <body>

                <header>
                    <img src="logotipo.png" width="200"/>
                </header>

                <div class="container">
                    <h1>Información de la Cuenta</h1>
                    <xsl:for-each select="catalogovod/cuenta">
                        <p><strong>Correo:</strong> <xsl:value-of select="@correo"/></p>
                        <xsl:for-each select="perfiles/perfil">
                            <h2>Perfil: <xsl:value-of select="@usuario"/></h2>
                            <p><strong>Idioma:</strong> <xsl:value-of select="@idioma"/></p>
                        </xsl:for-each>
                    </xsl:for-each>

                    <h1>Contenido</h1>
                    <xsl:for-each select="catalogovod/contenido">
                        <div class="section">
                            <h2>Películas</h2>
                            <table>
                                <tr>
                                    <th colspan="3">Películas</th>
                                </tr>
                                <tr>
                                    <th>Título</th>
                                    <th>Duración</th>
                                    <th>Género</th>
                                </tr>

                                <xsl:for-each select="peliculas/genero">
                                    <xsl:for-each select="titulo">
                                        <tr>
                                            <td><span><xsl:value-of select="."/></span></td>
                                            <td><xsl:value-of select="@duracion"/></td>
                                            <td><xsl:value-of select="../@nombre"/></td>
                                        </tr>
                                    </xsl:for-each>
                                </xsl:for-each>
                            </table>

                            <h2>Series</h2>
                            <table>
                                <tr>
                                    <th colspan="3">Series</th>
                                </tr>
                                <tr>
                                    <th>Título</th>
                                    <th>Duración</th>
                                    <th>Género</th>
                                </tr>

                                <xsl:for-each select="series/genero">
                                    <xsl:for-each select="titulo">
                                        <tr>
                                            <td><span><xsl:value-of select="."/></span></td>
                                            <td><xsl:value-of select="@duracion"/></td>
                                            <td><xsl:value-of select="../@nombre"/></td>
                                        </tr>
                                    </xsl:for-each>
                                </xsl:for-each>
                            </table>

                        </div>
                    </xsl:for-each>
                </div>

            </body>
        </html>
    </xsl:template>

</xsl:stylesheet>
