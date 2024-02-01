function getBlobUrl(url) {
  const baseUrl = window.URL || window.webkitURL;
  const blob = new Blob([`importScripts('${url}')`], {
    type: 'application/javascript',
  });

  return baseUrl.createObjectURL(blob);
}

function UrlExists(url) {
  const http = new XMLHttpRequest();

  http.open('HEAD', url, false);
  http.send();

  return http.status !== 404;
}

let webWorkerTaskPath =
  'public/jssz/convolveTask.js';

// If running with build completed and DIST folder present
if (UrlExists('public/jssz/cornerstoneWADOImageLoader.bundle.min.js')) {
  webWorkerTaskPath = `${window.location.protocol}//${window.location.host}/report/public/jssz/convolveTask.js`;
}

window.customWebWorkerConfig = {
  maxWebWorkers: navigator.hardwareConcurrency || 1,
  startWebWorkersOnDemand: true,
  webWorkerTaskPaths: [webWorkerTaskPath],
  taskConfiguration: {
    decodeTask: {
      initializeCodecsOnStartup: false,
    },
  },
};
