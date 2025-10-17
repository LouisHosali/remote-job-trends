<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Remote Job Trends 2025</title>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    :root{
      --font-size:16px;
      --background:#ffffff;
      --foreground:#111111;
      --card:#ffffff;
      --border:rgba(0,0,0,0.12);
      --muted:#666666;
      --secondary:#f2f3f7;
      --radius:10px;

      /* Layout-Hilfswerte */
      --chart-gap:28px;
      --chart-card-h:560px;
      --chart-title-h:28px;
      --chart-title-gap:8px;
    }

    *{box-sizing:border-box}
    html{font-size:var(--font-size)}
    body{
      font:16px/1.5 system-ui,-apple-system,Segoe UI,Inter,Roboto,sans-serif;
      margin:0;color:var(--foreground);background:#fafafa;
    }
    header,main,footer{max-width:1100px;margin:auto;padding:16px}
    h1{margin:8px 0 4px}
    h2{margin:16px 0 8px;font-size:1.25rem}
    .sub{color:var(--muted);margin:0}

    /* gleichmäßiger Abstand */
    .grid{display:grid;gap:var(--chart-gap)}
    .kpis{grid-template-columns:repeat(3,minmax(0,1fr))}
    .cards{grid-template-columns:repeat(2,minmax(0,1fr))}
    @media (max-width:900px){.kpis,.cards{grid-template-columns:1fr}}

    .card{
      background:var(--card);
      border:1px solid var(--border);
      border-radius:var(--radius);
      padding:16px;
    }
    .badge{
      display:inline-flex;align-items:center;gap:6px;
      padding:2px 8px;font-size:12px;border-radius:999px;
      background:var(--secondary);color:var(--foreground);border:1px solid var(--border);
    }
    .sep{height:1px;background:var(--border);margin:8px 0 16px}

    .kpi-title{color:var(--muted);font-size:.9rem;margin:0 0 6px}
    .kpi-val{font-weight:700;font-size:1.6rem}

    label{font-size:.9rem;color:var(--muted);display:block;margin-bottom:6px}
    select{width:100%;padding:.65rem .75rem;border:1px solid var(--border);border-radius:10px;background:#fff}

    /* === Charts === */
    .charts{margin-bottom:48px}

    .charts .card{
      height:var(--chart-card-h);
      display:flex;
      flex-direction:column;
      overflow:hidden;
      border-radius:var(--radius);
      padding:16px;
    }

    .charts .card h3{
      margin:4px 0 var(--chart-title-gap);
      height:var(--chart-title-h);
      line-height:var(--chart-title-h);
    }

    /* Canvas exakt innerhalb der Kachel */
    .charts .card canvas{
      display:block;
      width:100%;
      height:calc(100% - var(--chart-title-h) - var(--chart-title-gap) - 2px);
      background:transparent;
      border-radius:8px;
    }

    @media (max-width:900px){
      :root{ --chart-card-h:380px; }
    }

    footer{color:var(--muted);font-size:.95rem;border-top:1px solid var(--border);margin-top:24px;padding-top:24px}
  </style>
</head>
<body>
<header>
  <div class="card" style="padding:20px">
    <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <path d="M4 20h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        <rect x="6" y="10" width="3" height="8" rx="1" fill="currentColor"/>
        <rect x="11" y="6" width="3" height="12" rx="1" fill="currentColor"/>
        <rect x="16" y="13" width="3" height="5" rx="1" fill="currentColor"/>
      </svg>
      <span class="badge">UX Concept</span>
    </div>

    <h1>Remote Job Trends 2025</h1>
    <p class="sub">Wir tracken täglich neue Stellenangebote von Remote&nbsp;OK und zeigen, welche Skills und Rollen gefragt sind.</p>
  </div>

  <div class="sep"></div>

  <section>
    <h2 style="margin-top:0">Übersicht</h2>
    <div class="grid kpis" aria-label="Key Metrics">
      <div class="card">
        <p class="kpi-title">Jobs gesammelt</p>
        <p class="kpi-val" id="kpiTotal" data-kpi-total>–</p>
        <small id="kpiToday" class="sub"></small>
      </div>
      <div class="card">
        <p class="kpi-title">Top-Skill</p>
        <p class="kpi-val" id="kpiTopTag">–</p>
        <small class="sub">meistgenannter Tag</small>
      </div>
      <div class="card">
        <p class="kpi-title">Aktivste Zeit</p>
        <p class="kpi-val" id="kpiPeak">–</p>
        <small class="sub">Tag • Stunde</small>
      </div>
    </div>
  </section>

  <div class="sep"></div>

  <section>
    <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <path d="M4 6h16M7 12h10M10 18h4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
      </svg>
      <h2 style="margin:0">Filter</h2>
    </div>
    <div class="grid cards" style="align-items:end">
      <div>
        <label for="skill">Skill auswählen</label>
        <select id="skill"><option value="">Alle Skills</option></select>
      </div>
      <div>
        <label for="role">Rolle auswählen</label>
        <select id="role">
          <option value="">Alle Rollen</option>
          <option value="dev">Developer</option>
          <option value="design">Design</option>
          <option value="data">Data</option>
          <option value="pm">PM</option>
          <option value="other">Other</option>
        </select>
      </div>
    </div>
  </section>
</header>

<main>
  <section class="charts">
    <h2>Datenvisualisierung</h2>
    <div class="grid cards">
      <div class="card">
        <h3>Jobs pro Tag</h3>
        <canvas id="chartDaily"></canvas>
      </div>
      <div class="card">
        <h3>Rollenmix</h3>
        <canvas id="chartRole"></canvas>
      </div>
      <div class="card">
        <h3>Top Skills</h3>
        <canvas id="chartTags"></canvas>
      </div>
      <div class="card">
        <h3>Aktivitäts-Heatmap</h3>
        <canvas id="chartHeat"></canvas>
      </div>
    </div>
  </section>

  <section class="card" style="margin-top:36px">
    <h2>Was zeigen die Daten?</h2>
    <ul>
      <li><strong>Python/AI</strong> zählt häufig zu den gefragtesten Skills.</li>
      <li><strong>Developer</strong> dominieren den Rollenmix; Design & PM sind seltener.</li>
      <li>Die meisten Postings erscheinen werktags, Peak am Vormittag.</li>
    </ul>
  </section>
</main>

<footer>
  <div class="grid cards">
    <div>
      <p>Quelle: Remote OK API</p>
      <p>Letzte Aktualisierung: <span id="lastUpdated"></span></p>
    </div>
    <div style="text-align:right">
      <a href="#" class="sub">GitHub</a> •
      <a href="#" class="sub">Figma</a> •
      <a href="#" class="sub">Kontakt</a>
    </div>
  </div>
</footer>

<script>
  document.getElementById('lastUpdated').textContent =
    new Date().toLocaleDateString('de-DE');

  const API_BASE = '/api';
  const $skill = document.getElementById('skill');
  const $role  = document.getElementById('role');
  let chDaily, chRole, chTags, chHeat;
  const dayNames = ['So','Mo','Di','Mi','Do','Fr','Sa'];

  async function fetchJSON(url){
    const r = await fetch(url);
    if(!r.ok) throw new Error('HTTP '+r.status);
    return r.json();
  }

  function makeChart(ctx, type, cfg){
    return new Chart(ctx, {
      type,
      data: cfg.data,
      options: {
        responsive:true,
        maintainAspectRatio:false,

        // Innenabstand für sichtbare Achsenbeschriftungen (unten erweitert)
        layout: {
          padding: { top: 4, right: 8, bottom: 38, left: 8 } // ⬅️ +20 px mehr unten
        },

        plugins:{
          legend:{
            display:true,
            labels:{ color:'#111', font:{ size:12 } }
          }
        },

        scales:{
          x:{
            ticks:{ color:'#111', font:{ size:12 }, padding:6 },
            grid:{ color:'rgba(0,0,0,0.1)' }
          },
          y:{
            ticks:{ color:'#111', font:{ size:12 }, padding:6 },
            grid:{ color:'rgba(0,0,0,0.1)' }
          }
        },
        ...cfg.options
      }
    });
  }

  function updateChart(chart,cfg){ chart.data = cfg.data; chart.update(); }

  async function loadKPIs(){
    const daily = await fetchJSON(`${API_BASE}/jobs-per-day.php`);
    const total = daily.reduce((s,x)=>s + Number(x.c), 0);
    document.getElementById('kpiTotal').textContent = total.toLocaleString('de-CH');
    const todayStr = new Date().toISOString().slice(0,10);
    const today = daily.find(x => x.d === todayStr);
    document.getElementById('kpiToday').textContent = today ? `+${today.c} heute` : '';
    const tags = await fetchJSON(`${API_BASE}/top-tags.php?limit=1`);
    document.getElementById('kpiTopTag').textContent = (tags[0]?.tag || '–').toUpperCase();
    const heat = await fetchJSON(`${API_BASE}/heatmap.php`);
    if (heat.length){
      const max = heat.reduce((m,x)=> x.c>m.c?x:m, heat[0]);
      document.getElementById('kpiPeak').textContent =
        `${dayNames[Number(max.dow)]} • ${String(max.h).padStart(2,'0')}:00`;
    }
  }

  async function loadFilters(){
    const list = await fetchJSON(`${API_BASE}/top-tags.php?limit=50`);
    for(const t of list){
      const opt=document.createElement('option');
      opt.value=t.tag;opt.textContent=t.tag.toUpperCase();
      $skill.appendChild(opt);
    }
  }

  function qs(params){
    return Object.entries(params)
      .filter(([,v])=>v!==''&&v!=null)
      .map(([k,v])=>`${encodeURIComponent(k)}=${encodeURIComponent(v)}`)
      .join('&');
  }

  async function loadCharts(){
    const params={};
    if($skill.value)params.tag=$skill.value;

    const daily=await fetchJSON(`${API_BASE}/jobs-per-day.php`+(params.tag?`?${qs(params)}`:''));
    const cfgDaily={data:{labels:daily.map(x=>x.d),datasets:[{label:'Jobs',data:daily.map(x=>Number(x.c))}]}};

    const rmUrl=`${API_BASE}/role-mix.php`+(params.tag?`?tag=${encodeURIComponent($skill.value)}`:'');
    const roleMix=await fetchJSON(rmUrl);
    const cfgRole={data:{labels:roleMix.map(x=>x.role.toUpperCase()),datasets:[{data:roleMix.map(x=>Number(x.c))}]}};

    const topTags=await fetchJSON(`${API_BASE}/top-tags.php?limit=10`);
    const GREEN='#00A73D',GREEN_A='#00A73D55';
    const cfgTags={data:{labels:topTags.map(x=>x.tag.toUpperCase()),datasets:[{label:'Vorkommen',data:topTags.map(x=>Number(x.c)),backgroundColor:GREEN_A,borderColor:GREEN,borderWidth:2}]},options:{indexAxis:'y'}};

    const heat=await fetchJSON(`${API_BASE}/heatmap.php`);
    const byHour=Array.from({length:24},(_,h)=>({h,c:0}));
    heat.forEach(x=>{byHour[x.h].c+=Number(x.c)});
    const PURPLE='#990FFA',PURPLE_A='#990FFA55';
    const cfgHeat={data:{labels:byHour.map(x=>String(x.h).padStart(2,'0')+':00'),datasets:[{label:'Posts',data:byHour.map(x=>x.c),backgroundColor:PURPLE_A,borderColor:PURPLE,borderWidth:2}]}};

    chDaily?updateChart(chDaily,cfgDaily):chDaily=makeChart(document.getElementById('chartDaily').getContext('2d'),'line',cfgDaily);
    chRole?updateChart(chRole,cfgRole):chRole=makeChart(document.getElementById('chartRole').getContext('2d'),'doughnut',cfgRole);
    chTags?updateChart(chTags,cfgTags):chTags=makeChart(document.getElementById('chartTags').getContext('2d'),'bar',cfgTags);
    chHeat?updateChart(chHeat,cfgHeat):chHeat=makeChart(document.getElementById('chartHeat').getContext('2d'),'bar',cfgHeat);
  }

  function debounce(fn,ms=200){let t;return(...a)=>{clearTimeout(t);t=setTimeout(()=>fn(...a),ms);};}

  async function boot(){
    await loadFilters();
    await loadKPIs();
    await loadCharts();
    $skill.addEventListener('change',debounce(loadCharts,200));
    $role.addEventListener('change',debounce(loadCharts,200));
  }
  boot().catch(console.error);
</script>
</body>
</html>