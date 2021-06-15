
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
        modalAffectedSolutions: 'Betroffene Lösungen:',
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
            description: 'Funktionale Cookies sind solche, die zwingend erforderlich sind, um wesentliche Funktionen der Website zu gewährleisten. Sie gewähren das Einhalten von erhöhten Sicherheitsanforderungen.',
          }
        }
      }
    },
    analytic: {
      needed: false,
      wanted: false,
      checked: false,
      language: {
        locale: {
          de: {
            name: 'Analyse Cookies',
            description: 'Analyse Cookies sind ein einfaches Tool, mit dem wir messen können, wie Nutzer mit Website-Inhalten interagieren. Wir verwenden es für die Verbesserung unserer Website.',
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
          domain: '.google.com'
        },
        {
          // Regex matching cookie name.
          name: /^_GRECAPTCHA/,
          domain: '.google.com'
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
    googleanalytics: {
      category: 'analytic',
      type: 'script-tag',
      search: 'googleanalytics',
      cookies: [
        {
          // Known cookie name.
          name: '_ga',
          // Expected cookie domain.
          domain: '.hagen-energiesysteme.de'
        },
        {
          // Regex matching cookie name.
          name: /^_ga/,
          domain: '.hagen-energiesysteme.de'
        },
        {
          // Known cookie name.
          name: '_ga_VCJ0L5L848',
          // Expected cookie domain.
          domain: '.hagen-energiesysteme.de'
        },
        {
          // Regex matching cookie name.
          name: /^_ga/,
          domain: '.hagen-energiesysteme.de'
        }
      ],
      language: {
        locale: {
          de: {
            name: 'Google Analytics',
          },
        }
      }
    },
  }
});