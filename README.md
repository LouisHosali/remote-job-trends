# 🧠 Remote Job Trends 2025

**Autor:** Louis Hosali  
**Modul:** IM3 – FHGR, HS25  
**Dozent:** Philippe Dubach  
**Projektart:** UX / Data / Web Application  
**Live-Version:** [https://heimzeit.online/im3/public/index.php](https://heimzeit.online/im3/public/index.php)

---

## 🎯 Projektidee

Das Projekt **Remote Job Trends 2025** analysiert täglich aktuelle Stellenanzeigen der Plattform *Remote OK* und zeigt,  
welche **Skills** und **Rollen** im Remote-Arbeitsmarkt am meisten gefragt sind.  
Die Daten werden in einer **interaktiven Web-App** visualisiert, die Filter-, KPI- und Diagrammfunktionen kombiniert.

---

## 🧩 Struktur
---

## 🧠 UX-Ziel

- Übersichtliche, datenbasierte Darstellung der aktuellen Remote-Arbeitsmarktdynamik  
- Interaktive Diagramme für tägliche, wöchentliche und stündliche Aktivitätsmuster  
- Filterbare Skills & Rollen für individuelle Auswertungen  
- Klare, zugängliche Oberfläche im Stil eines Dashboards  

---

## 📊 Visualisierte Daten

| Kategorie              | Diagrammtyp               | Beschreibung |
|------------------------|---------------------------|---------------|
| **Jobs pro Tag**       | Line Chart                | Zeitliche Entwicklung der Stellenausschreibungen |
| **Rollenmix**          | Doughnut Chart            | Verhältnis der Rollen (Dev, Design, Data, PM, Other) |
| **Top Skills**         | Bar Chart (horizontal)    | Häufigste Skills aus aktuellen Anzeigen |
| **Aktivitäts-Heatmap** | Column Chart              | Häufigkeit der Postings pro Stunde |

**Farbcodierung:**
- 🟩 **Grün (#00A73D)** – Top Skills  
- 🟣 **Violett (#990FFA)** – Aktivitäts-Heatmap  
- ⚪ Standardfarben für Line und Doughnut Charts  

---

## ⚙️ Tech-Stack

- **Frontend:** HTML / CSS / JavaScript  
- **Visualisierung:** [Chart.js](https://www.chartjs.org)  
- **Backend:** PHP 8  
- **API-Datenquelle:** [Remote OK API](https://remoteok.com/api)  
- **Deployment:** Infomaniak Hosting  
- **Versionskontrolle:** Git + GitHub  

---

## 🔒 Datenschutz & Struktur

- Keine personenbezogenen Daten  
- `.gitignore` schützt sensible Dateien:  
  - `config.php`, `etl/config.php` (API-/DB-Zugangsdaten)  
  - generierte Dateien (`public/sql/*.json`)  
- Nur Template- und Frontend-Dateien sind öffentlich einsehbar  

---

## 🧭 Lernziele & Erkenntnisse

- Praktischer Umgang mit **Daten-APIs** und deren Visualisierung  
- Umsetzung eines **responsive Dashboards** mit Chart.js  
- Anwendung von **Git / GitHub / Deployment-Workflows**  
- UX-Designprinzipien für **Datenlesbarkeit & Informationshierarchie**

---

## 📁 Projekt-Repository

🔗 [GitHub – LouisHosali / remote-job-trends](https://github.com/LouisHosali/remote-job-trends)

---

© 2025 Louis Hosali · FHGR – Multimedia Production · Modul IM3