import {
  TButton,
  TCheckbox,
  TDatepicker,
  TInput,
  TInputGroup,
  TModal,
  TRadioGroup,
  TSelect,
  TToggle
} from 'vue-tailwind/dist/components'
import Swedish from 'vue-tailwind/dist/l10n/sv'

const tailwindSettings = {
  't-button': {
      component: TButton,
      props: {
          fixedClasses:
              'inline-flex items-center px-4 py-2 border border-transparent text-sm font-bold uppercase tracking-wide rounded-md shadow-sm text-white focus:outline-none focus:ring-2 focus:ring-offset-2',
          classes:
              'bg-teal-600 hover:bg-teal-700 focus:ring-teal-500 dark:bg-teal-800 dark:hover:bg-teal-700 dark:ring-offset-gray-700',
          variants: {
              close:
                  'bg-white border-gray-300 text-gray-600 hover:bg-gray-50 focus:ring-teal-500 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-700 dark:hover:bg-gray-800 dark:ring-offset-gray-700',
              danger:
                  'bg-red-600 hover:bg-red-700 active:bg-red-900 focus:ring-red-500 dark:ring-offset-gray-700',
              second:
                  'bg-white border-gray-300 text-gray-600 hover:bg-gray-50 focus:ring-teal-500 dark:bg-black dark:text-gray-400 dark:border-gray-700 dark:hover:bg-gray-900 dark:ring-offset-gray-700'
          }
      }
  },

  't-checkbox': {
      component: TCheckbox,
      props: {
          wrapped: true,
          classes: {
              label: 'text-sm mx-2 text-gray-700 dark:text-gray-400',
              input:
                  'text-teal-500 transition duration-100 ease-in-out border-gray-300 rounded shadow-sm focus:border-teal-500 focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50 focus:ring-offset-0 disabled:opacity-50 disabled:cursor-not-allowed',
              inputWrapper: 'inline-flex',
              wrapper: 'flex items-start'
              //labelChecked: '',
              //inputWrapperChecked: '',
              //wrapperChecked: ''
          },
          variants: {
              error: 'text-red-500 focus:ring-red-500',
              success: 'text-green-500 focus:ring-green-500'
          }
      }
  },

  't-datepicker': {
      component: TDatepicker,
      props: {
          locale: Swedish,
          fixedClasses: {
              navigator: 'flex',
              navigatorViewButton: 'flex items-center',
              navigatorViewButtonIcon: 'flex-shrink-0 h-5 w-5',
              navigatorViewButtonBackIcon: 'flex-shrink-0 h-5 w-5',
              navigatorLabel: 'flex items-center py-1',
              navigatorPrevButtonIcon: 'h-6 w-6 inline-flex',
              navigatorNextButtonIcon: 'h-6 w-6 inline-flex',
              inputWrapper: 'relative',
              viewGroup: 'inline-flex flex-wrap',
              view: 'w-64',
              calendarDaysWrapper: 'grid grid-cols-7',
              calendarHeaderWrapper: 'grid grid-cols-7',
              monthWrapper: 'grid grid-cols-4',
              yearWrapper: 'grid grid-cols-4',
              input:
                  'block w-full px-3 py-2 transition duration-100 ease-in-out border rounded shadow-sm focus:border-teal-500 focus:ring-2 focus:ring-teal-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed',
              clearButton:
                  'flex flex-shrink-0 items-center justify-center absolute right-0 top-0 m-2 h-6 w-6',
              clearButtonIcon: 'fill-current h-3 w-3'
          },
          classes: {
              wrapper: 'flex flex-col',
              dropdownWrapper: 'relative z-10',
              dropdown:
                  'origin-top-left absolute rounded shadow bg-white overflow-hidden mt-1',
              enterClass: '',
              enterActiveClass:
                  'transition ease-out duration-100 transform opacity-0 scale-95',
              enterToClass: 'transform opacity-100 scale-100',
              leaveClass: 'transition ease-in transform opacity-100 scale-100',
              leaveActiveClass: '',
              leaveToClass: 'transform opacity-0 scale-95 duration-75',
              inlineWrapper: '',
              inlineViews: 'rounded bg-white border mt-1 inline-flex',
              inputWrapper: '',
              input: 'text-black placeholder-gray-400 border-gray-300',
              clearButton:
                  'hover:bg-gray-100 rounded transition duration-100 ease-in-out text-gray-600',
              clearButtonIcon: '',
              viewGroup: '',
              view: '',
              navigator: 'pt-2 px-3',
              navigatorViewButton:
                  'transition ease-in-out duration-100 inline-flex cursor-pointer rounded-full px-2 py-1 -ml-1 hover:bg-gray-100',
              navigatorViewButtonIcon: 'fill-current text-gray-400',
              navigatorViewButtonBackIcon: 'fill-current text-gray-400',
              navigatorViewButtonMonth: 'text-gray-700 font-semibold',
              navigatorViewButtonYear: 'text-gray-500 ml-1',
              navigatorViewButtonYearRange: 'text-gray-500 ml-1',
              navigatorLabel: 'py-1',
              navigatorLabelMonth: 'text-gray-700 font-semibold',
              navigatorLabelYear: 'text-gray-500 ml-1',
              navigatorPrevButton:
                  'transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 rounded-full p-1 ml-2 ml-auto disabled:opacity-50 disabled:cursor-not-allowed',
              navigatorNextButton:
                  'transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 rounded-full p-1 -mr-1 disabled:opacity-50 disabled:cursor-not-allowed',
              navigatorPrevButtonIcon: 'text-gray-400',
              navigatorNextButtonIcon: 'text-gray-400',
              calendarWrapper: 'px-3 pt-2',
              calendarHeaderWrapper: '',
              calendarHeaderWeekDay:
                  'uppercase text-xs text-gray-500 w-8 h-8 flex items-center justify-center',
              calendarDaysWrapper: '',
              calendarDaysDayWrapper: 'w-full h-8 flex flex-shrink-0 items-center',
              otherMonthDay:
                  'text-sm rounded-full w-8 h-8 mx-auto hover:bg-teal-100 text-gray-400 disabled:opacity-50 disabled:cursor-not-allowed',
              emptyDay: '',
              inRangeFirstDay:
                  'text-sm bg-teal-500 text-white w-full h-8 rounded-l-full',
              inRangeLastDay:
                  'text-sm bg-teal-500 text-white w-full h-8 rounded-r-full',
              inRangeDay:
                  'text-sm bg-teal-200 w-full h-8 disabled:opacity-50 disabled:cursor-not-allowed',
              selectedDay:
                  'text-sm rounded-full w-8 h-8 mx-auto bg-teal-500 text-white disabled:opacity-50 disabled:cursor-not-allowed',
              activeDay:
                  'text-sm rounded-full bg-teal-100 w-8 h-8 mx-auto disabled:opacity-50 disabled:cursor-not-allowed',
              highlightedDay:
                  'text-sm rounded-full bg-teal-200 w-8 h-8 mx-auto disabled:opacity-50 disabled:cursor-not-allowed',
              day:
                  'text-sm rounded-full w-8 h-8 mx-auto hover:bg-teal-100 disabled:opacity-50 disabled:cursor-not-allowed',
              today:
                  'text-sm rounded-full w-8 h-8 mx-auto hover:bg-teal-100 disabled:opacity-50 disabled:cursor-not-allowed border border-teal-500',
              monthWrapper: 'px-3 pt-2',
              selectedMonth:
                  'text-sm rounded w-full h-12 mx-auto bg-teal-500 text-white',
              activeMonth: 'text-sm rounded w-full h-12 mx-auto bg-teal-100',
              month: 'text-sm rounded w-full h-12 mx-auto hover:bg-teal-100',
              yearWrapper: 'px-3 pt-2',
              year: 'text-sm rounded w-full h-12 mx-auto hover:bg-teal-100',
              selectedYear:
                  'text-sm rounded w-full h-12 mx-auto bg-teal-500 text-white',
              activeYear: 'text-sm rounded w-full h-12 mx-auto bg-teal-100'
          },
          variants: {
              danger: {
                  input: 'border-red-300 bg-red-50 placeholder-red-200 text-red-900',
                  clearButton: 'hover:bg-red-200 text-red-500'
              }
          }
      }
  },

  't-input': {
      component: TInput,
      props: {
          fixedClasses:
              'appearance-none block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none sm:text-sm',
          classes:
              'border-gray-300 placeholder-gray-400 focus:ring-teal-500 focus:border-teal-500 dark:bg-black dark:border-gray-700 dark:text-gray-400',
          variants: {
              error:
                  'bg-red-100 border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 '
          }
      }
  },

  't-input-group': {
      component: TInputGroup,
      props: {
          fixedClasses: {
              wrapper: 'col-span-4 sm:col-span-2',
              label: 'ml-1 block text-sm font-medium leading-5',
              body: '',
              feedback: 'text-sm',
              description: 'text-sm'
          },
          classes: {
              wrapper: '',
              label: ' text-gray-700 dark:text-gray-400',
              body: '',
              feedback: 'text-gray-500 dark:text-white',
              description: 'text-gray-500 dark:text-white'
          },
          variants: {
              error: {
                  label: 'text-red-600',
                  feedback: 'text-red-600'
              }
          }
      }
  },

  't-modal': {
      component: TModal,
      props: {
          fixedClasses: {
              overlay:
                  'z-40 overflow-auto scrolling-touch left-0 top-0 bottom-0 right-0 w-full h-full fixed bg-opacity-50',
              wrapper: 'relative mx-auto z-50 w-max h-max px-4 py-4',
              modal: 'overflow-visible relative rounded',
              body: 'p-2',
              header: 'border-b p-3 rounded-t',
              footer: 'p-2 rounded-b',
              close:
                  'flex items-center justify-center rounded-full absolute right-0 top-0 -m-3 h-8 w-8 transition duration-100 ease-in-out focus:ring-2 focus:ring-teal-500 focus:outline-none focus:ring-opacity-50'
          },
          classes: {
              overlay: 'bg-black',
              wrapper: '',
              modal:
                  'bg-white shadow border border-transparent dark:bg-black dark:border-gray-700',
              body: 'p-2 text-sm dark:text-gray-400',
              header: 'border-gray-100 dark:border-gray-700 dark:text-gray-400',
              footer: 'bg-gray-100 dark:bg-black',
              close: 'bg-gray-100 text-gray-600 hover:bg-gray-200',
              closeIcon: 'fill-current h-4 w-4',
              overlayEnterClass: '',
              overlayEnterActiveClass: 'opacity-0 transition ease-out duration-100',
              overlayEnterToClass: 'opacity-100',
              overlayLeaveClass: 'transition ease-in opacity-100',
              overlayLeaveActiveClass: '',
              overlayLeaveToClass: 'opacity-0 duration-75',
              enterClass: '',
              enterActiveClass: '',
              enterToClass: '',
              leaveClass: '',
              leaveActiveClass: '',
              leaveToClass: ''
          }
      }
  },

  't-radio-group': {
      component: TRadioGroup,
      props: {
          fixedClasses: {
              groupWrapper: 'flex',
              label: 'ml-3 block text-sm font-medium',
              labelChecked: '',
              wrapper: 'inline-flex items-center space-x-2',
              wrapperChecked: '',
              inputWrapper: 'inline-flex',
              inputWrapperChecked: '',
              input:
                  'h-4 w-4 transition duration-100 ease-in-out shadow-sm focus:ring-2 disabled:opacity-50 disabled:cursor-not-allowed'
          },
          classes: {
              groupWrapper: 'flex-col',
              label: 'text-gray-700 dark:text-gray-400',
              input:
                  'text-teal-600 border-gray-300 focus:border-teal-500 focus:ring-teal-500 dark:focus:ring-teal-500 dark:border-gray-700 dark:bg-black dark:ring-offset-gray-700'
          },
          variants: {
              row: {
                  groupWrapper: '',
                  wrapper: 'mr-4'
              }
          }
      }
  },

  't-select': {
      component: TSelect,
      props: {
          wrapped: true,
          classes: {
              wrapper: 'relative col-span-4 sm:col-span-2',
              input:
                  'appearance-none block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none sm:text-sm border-gray-300 placeholder-gray-400 focus:ring-teal-500 focus:border-teal-500 dark:bg-black dark:text-gray-400 dark:border-gray-700',
              arrowWrapper:
                  'pointer-events-none absolute inset-y-1 right-1 flex items-center px-2 text-gray-700 bg-white dark:bg-black dark:text-gray-400',
              arrow: 'fill-current h-4 w-4'
          },
          variants: {
              error: {
                  input:
                      'appearance-none block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none sm:text-sm border-red-300 bg-red-100 placeholder-red-400 focus:ring-teal-500 focus:border-teal-500 dark:bg-black dark:text-gray-400 dark:border-gray-700'
              }
          }
      }
  },

  't-toggle': {
      component: TToggle,
      props: {
          fixedClasses: {
              wrapper:
                  'relative inline-flex flex-shrink-0 cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500',
              wrapperChecked:
                  'relative inline-flex flex-shrink-0 cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500',
              wrapperDisabled:
                  'relative inline-flex flex-shrink-0 cursor-pointer transition-colors ease-in-out duration-200 opacity-50 cursor-not-allowed',
              wrapperCheckedDisabled:
                  'relative inline-flex flex-shrink-0 cursor-pointer transition-colors ease-in-out duration-200 opacity-50 cursor-not-allowed',
              button:
                  'inline-block absolute transform translate-x-0 transition ease-in-out duration-200',
              buttonChecked:
                  'inline-block absolute transform translate-x-full transition ease-in-out duration-200',
              checkedPlaceholder: 'inline-block',
              uncheckedPlaceholder: 'inline-block'
          },
          classes: {
              wrapper:
                  'bg-gray-200 focus:ring-teal-500 rounded-full border-2 border-transparent dark:ring-offset-gray-700 dark:bg-gray-500',
              wrapperChecked:
                  'bg-teal-500 focus:outline-none focus:shadow-outline rounded-full border-2 border-transparent dark:ring-offset-gray-700',
              button:
                  'h-5 w-5 rounded-full bg-white shadow  flex items-center justify-center text-gray-400 text-xs dark:bg-black',
              buttonChecked:
                  'h-5 w-5 rounded-full bg-white shadow  flex items-center justify-center text-teal-500 text-xs dark:bg-black',
              checkedPlaceholder:
                  'rounded-full w-5 h-5 flex items-center justify-center text-gray-500 text-xs',
              uncheckedPlaceholder:
                  'rounded-full w-5 h-5 flex items-center justify-center text-gray-500 text-xs'
          }
      }
  }
}

export default tailwindSettings
