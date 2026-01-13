import Vapi from '@vapi-ai/web';

function getMetaContent(name) {
  const el = document.querySelector(`meta[name="${name}"]`);
  return el ? el.getAttribute('content') : null;
}

function safeJsonParse(value) {
  if (!value) return null;
  try {
    return JSON.parse(value);
  } catch {
    return null;
  }
}

function setStatus(text) {
  const el = document.getElementById('vapi-status');
  if (el) el.textContent = text;
}

function main() {
  const publicKey = getMetaContent('vapi-public-key');
  const assistantId = getMetaContent('vapi-assistant-id');
  const metadata = safeJsonParse(getMetaContent('vapi-metadata')) || {};

  const startBtn = document.getElementById('vapi-start');
  const stopBtn = document.getElementById('vapi-stop');

  if (!startBtn || !stopBtn) return;

  if (!publicKey || !assistantId) {
    startBtn.disabled = true;
    stopBtn.disabled = true;
    setStatus('Voice assistant unavailable (missing configuration).');
    return;
  }

  const vapi = new Vapi(publicKey);

  vapi.on('call-start', () => {
    startBtn.disabled = true;
    stopBtn.disabled = false;
    setStatus('Call started.');
  });

  vapi.on('call-end', () => {
    startBtn.disabled = false;
    stopBtn.disabled = true;
    setStatus('Call ended.');
  });

  vapi.on('error', (err) => {
    startBtn.disabled = false;
    stopBtn.disabled = true;
    setStatus('Call error. Please try again.');
    // eslint-disable-next-line no-console
    console.error('Vapi error:', err);
  });

  startBtn.addEventListener('click', async () => {
    setStatus('Connecting...');
    try {
      await vapi.start(assistantId, { metadata });
    } catch (e) {
      setStatus('Unable to start call.');
      // eslint-disable-next-line no-console
      console.error(e);
    }
  });

  stopBtn.addEventListener('click', async () => {
    try {
      await vapi.stop();
    } catch (e) {
      // eslint-disable-next-line no-console
      console.error(e);
    }
  });

  // initial state
  startBtn.disabled = false;
  stopBtn.disabled = true;
  setStatus('Ready.');
}

document.addEventListener('DOMContentLoaded', main);

