@echo off

REM This script is called by DCV to convert printed xps files
REM into pdf. It is ivoked passing the path to the xps file as
REM input: dcv-xps2pdf.bat <input_xps_file>
REM and it is expected to put the pdf file on stdout

REM Uncomment when using GhostXPS for conversion
REM C:\gxps\gxps.exe -sDEVICE=pdfwrite -sOutputFile=%stdout -dNOPAUSE %1

REM LibGXPS-based xps to pdf converter
set pdf_file="%~dp0\%~n1.pdf"
"%~dp0\xpstopdf.exe" %1 %pdf_file%
type %pdf_file%
del /f /q %pdf_file%
