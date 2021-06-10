
window.CookieConsent.init({
  // More link URL on bar
  modalMainTextMoreLink: null,
  // How lond to wait until bar comes up
  barTimeout: 1000,
  // Look and feel
  theme: {
    barColor: '#2C7CBF',
    barTextColor: '#FFF',
    barMainButtonColor: '#FFF',
    barMainButtonTextColor: '#2C7CBF',
    modalMainButtonColor: '#4285F4',
    modalMainButtonTextColor: '#FFF',
  },
  language: {
    // Current language
    current: 'de',
    locale: {
      de: {
        barMainText: 'Wir respektieren ihre Privatsphäre',
        barLinkSetting: 'Cookie Einstellungen',
        barBtnAcceptAll: 'Zustimmen',
        modalMainTitle: 'Cookie Einstellungen',
        modalMainText: 'Cookies sind kleine Textdateien, die auf Computern oder Smartphones, in der Regel im Ordner des jeweiligen Browsers, abgespeichert werden. Mit ihnen lässt sich nachverfolgen, welche Webseiten der Nutzer besucht hat. Dies hat zum Ziel, passende Werbung im Netz zu schalten oder per Google Analytics den Traffic auf eine Webseite zu analysieren.',
        modalBtnSave: 'Einstellungen speichern',
        modalBtnAcceptAll: 'Alle Cookies anzeptieren und schließen',
        modalAffectedSolutions: 'Affected solutions:',
        learnMore: 'Learn More',
        on: 'On',
        off: 'Off',
      }
    }
  },
  // List all the categories you want to display
  categories: {
    functional: {
      needed: true,
      wanted: true,
      checked: true,
      language: {
        locale: {
          de: {
            name: 'Funktionale Cookies',
            description: 'Dienen zur konfortablen Website-Funktionen',
          }
        }
      }
    },
  },
  // List actual services here
  services: {
    reCaptcha: {
      category: 'functional',
      type: 'script-tag',
      search: 'grecaptcha',
      cookies: [
        {
          // Known cookie name.
          name: '_GRECAPTCHA',
          // Expected cookie domain.
          domain: 'google.com'
        },
        {
          // Regex matching cookie name.
          name: /^_GRECAPTCHA/,
          domain: 'google.com'
        }
      ],
      language: {
        locale: {
          de: {
            name: 'Google reCaptcha',
          },
        }
      }
    },
  }
});