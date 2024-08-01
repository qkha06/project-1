<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row row-card d-block justify-content-between d-md-flex">
        <div class="col-md-6 mb-4">
          <div class="mb-1">
            <ol class="breadcrumb" aria-label="breadcrumbs">
              @php
              $paths = array_filter(array_map('trim', explode('/', request()->path())), 'strlen')
              @endphp
              @foreach ($paths as $path)
              <li class="breadcrumb-item"><a href="#">{{ ucfirst($path) }}</a></li>
              @endforeach
            </ol>
          </div>
          <h2 class="page-title">
            <span class="text-truncate" style="line-height: 1.5rem">{{ $title }}</span>
          </h2>
        </div>
        <div class="col-md-6 mb-4 w-auto">
          {!! $rbc ?? '' !!}
        </div>

      </div>
    </div>
  </div>

  <style>
    :root {
    --litepicker-container-months-color-bg: #fff;
    --litepicker-container-months-box-shadow-color: #ddd;
    --litepicker-footer-color-bg: #fff;
    --litepicker-footer-box-shadow-color: #ddd;
    --litepicker-tooltip-color-bg: #fff;
    --litepicker-month-header-color: #333;
    --litepicker-button-prev-month-color: #9e9e9e;
    --litepicker-button-next-month-color: #9e9e9e;
    --litepicker-button-prev-month-color-hover: #2196f3;
    --litepicker-button-next-month-color-hover: #2196f3;
    --litepicker-month-width: calc(var(--litepicker-day-width) * 7);
    --litepicker-month-weekday-color: #9e9e9e;
    --litepicker-month-week-number-color: #9e9e9e;
    --litepicker-day-width: 38px;
    --litepicker-day-color: #333;
    --litepicker-day-color-hover: #2196f3;
    --litepicker-is-today-color: #f44336;
    --litepicker-is-in-range-color: #bbdefb;
    --litepicker-is-locked-color: #9e9e9e;
    --litepicker-is-start-color: #fff;
    --litepicker-is-start-color-bg: #2196f3;
    --litepicker-is-end-color: #fff;
    --litepicker-is-end-color-bg: #2196f3;
    --litepicker-button-cancel-color: #fff;
    --litepicker-button-cancel-color-bg: #9e9e9e;
    --litepicker-button-apply-color: #fff;
    --litepicker-button-apply-color-bg: #2196f3;
    --litepicker-button-reset-color: #909090;
    --litepicker-button-reset-color-hover: #2196f3;
    --litepicker-highlighted-day-color: #333;
    --litepicker-highlighted-day-color-bg: #ffeb3b
  }

  .show-week-numbers {
      --litepicker-month-width: calc(var(--litepicker-day-width) * 8)
  }

.litepicker {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    font-size: 0.8em;
    display: none;
    background-color: var(--litepicker-container-months-color-bg);
    box-shadow: 0 0 5px var(--litepicker-container-months-box-shadow-color);
    border: var(--tblr-border-width) var(--tblr-border-style) var(--tblr-border-color);
    border-radius: var(--tblr-border-radius);
}

.litepicker button {
    border: none;
    background: none
}

.litepicker .container__main {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}

.litepicker .container__months {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    width: calc(var(--litepicker-month-width) + 10px);
    -webkit-box-sizing: content-box;
    box-sizing: content-box
}

.litepicker .container__months.columns-2 {
    width: calc((var(--litepicker-month-width) * 2) + 20px)
}

.litepicker .container__months.columns-3 {
    width: calc((var(--litepicker-month-width) * 3) + 30px)
}

.litepicker .container__months.columns-4 {
    width: calc((var(--litepicker-month-width) * 4) + 40px)
}

.litepicker .container__months.split-view .month-item-header .button-previous-month,
.litepicker .container__months.split-view .month-item-header .button-next-month {
    visibility: visible
}

.litepicker .container__months .month-item {
    padding: 5px;
    width: var(--litepicker-month-width);
    -webkit-box-sizing: content-box;
    box-sizing: content-box
}

.litepicker .container__months .month-item-header {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    font-weight: 500;
    padding: 10px 5px;
    text-align: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    color: var(--litepicker-month-header-color)
}

.litepicker .container__months .month-item-header div {
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1
}

.litepicker .container__months .month-item-header div>.month-item-name {
    margin-right: 5px
}

.litepicker .container__months .month-item-header div>.month-item-year {
    padding: 0
}

.litepicker .container__months .month-item-header .reset-button {
    color: var(--litepicker-button-reset-color)
}

.litepicker .container__months .month-item-header .reset-button>svg {
    fill: var(--litepicker-button-reset-color)
}

.litepicker .container__months .month-item-header .reset-button * {
    pointer-events: none
}

.litepicker .container__months .month-item-header .reset-button:hover {
    color: var(--litepicker-button-reset-color-hover)
}

.litepicker .container__months .month-item-header .reset-button:hover>svg {
    fill: var(--litepicker-button-reset-color-hover)
}

.litepicker .container__months .month-item-header .button-previous-month,
.litepicker .container__months .month-item-header .button-next-month {
    visibility: hidden;
    text-decoration: none;
    padding: 3px 5px;
    border-radius: 3px;
    -webkit-transition: color 0.3s, border 0.3s;
    transition: color 0.3s, border 0.3s;
    cursor: default
}

.litepicker .container__months .month-item-header .button-previous-month *,
.litepicker .container__months .month-item-header .button-next-month * {
    pointer-events: none
}

.litepicker .container__months .month-item-header .button-previous-month {
    color: var(--litepicker-button-prev-month-color)
}

.litepicker .container__months .month-item-header .button-previous-month>svg,
.litepicker .container__months .month-item-header .button-previous-month>img {
    fill: var(--litepicker-button-prev-month-color)
}

.litepicker .container__months .month-item-header .button-previous-month:hover {
    color: var(--litepicker-button-prev-month-color-hover)
}

.litepicker .container__months .month-item-header .button-previous-month:hover>svg {
    fill: var(--litepicker-button-prev-month-color-hover)
}

.litepicker .container__months .month-item-header .button-next-month {
    color: var(--litepicker-button-next-month-color)
}

.litepicker .container__months .month-item-header .button-next-month>svg,
.litepicker .container__months .month-item-header .button-next-month>img {
    fill: var(--litepicker-button-next-month-color)
}

.litepicker .container__months .month-item-header .button-next-month:hover {
    color: var(--litepicker-button-next-month-color-hover)
}

.litepicker .container__months .month-item-header .button-next-month:hover>svg {
    fill: var(--litepicker-button-next-month-color-hover)
}

.litepicker .container__months .month-item-weekdays-row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    justify-self: center;
    -webkit-box-pack: start;
    -ms-flex-pack: start;
    justify-content: flex-start;
    color: var(--litepicker-month-weekday-color)
}

.litepicker .container__months .month-item-weekdays-row>div {
    padding: 5px 0;
    font-size: 85%;
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    width: var(--litepicker-day-width);
    text-align: center
}

.litepicker .container__months .month-item:first-child .button-previous-month {
    visibility: visible
}

.litepicker .container__months .month-item:last-child .button-next-month {
    visibility: visible
}

.litepicker .container__months .month-item.no-previous-month .button-previous-month {
    visibility: hidden
}

.litepicker .container__months .month-item.no-next-month .button-next-month {
    visibility: hidden
}

.litepicker .container__days {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    justify-self: center;
    -webkit-box-pack: start;
    -ms-flex-pack: start;
    justify-content: flex-start;
    text-align: center;
    -webkit-box-sizing: content-box;
    box-sizing: content-box
}

.litepicker .container__days>div,
.litepicker .container__days>a {
    padding: 5px 0;
    width: var(--litepicker-day-width)
}

.litepicker .container__days .day-item {
    color: var(--litepicker-day-color);
    text-align: center;
    text-decoration: none;
    border: 1px solid #e4e7e7;
    border-radius: 0;
    -webkit-transition: color 0.3s, border 0.3s;
    transition: color 0.3s, border 0.3s;
    cursor: default
}

.litepicker .container__days .day-item:hover {
    background-color: #e4e7e7
}

.litepicker .container__days .day-item.is-today {
    color: var(--litepicker-is-today-color)
}

.litepicker .container__days .day-item.is-locked {
    color: var(--litepicker-is-locked-color)
}

.litepicker .container__days .day-item.is-locked:hover {
    color: var(--litepicker-is-locked-color);
    -webkit-box-shadow: none;
    box-shadow: none;
    cursor: default
}

.litepicker .container__days .day-item.is-in-range {
    background-color: var(--litepicker-is-in-range-color);
    border-radius: 0;
    border: 1px solid var(--litepicker-is-in-range-color)
}

.litepicker .container__days .day-item.is-start-date {
    color: var(--litepicker-is-start-color);
    background-color: var(--litepicker-is-start-color-bg);
    border: 1px solid transparent;
    /* border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0 */
}

/* .litepicker .container__days .day-item.is-start-date.is-flipped {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px
} */

.litepicker .container__days .day-item.is-end-date {
    color: var(--litepicker-is-end-color);
    background-color: var(--litepicker-is-end-color-bg);
    border: 1px solid transparent;
    /* border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px */
}

/* .litepicker .container__days .day-item.is-end-date.is-flipped {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0
}

.litepicker .container__days .day-item.is-start-date.is-end-date {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px
} */

.litepicker .container__days .day-item.is-highlighted {
    color: var(--litepicker-highlighted-day-color);
    background-color: var(--litepicker-highlighted-day-color-bg)
}

.litepicker .container__days .week-number {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    color: var(--litepicker-month-week-number-color);
    font-size: 85%
}

.litepicker .container__footer {
    text-align: right;
    padding: 10px 5px;
}

.litepicker .container__footer .preview-date-range {
    margin-right: 10px;
    font-size: 90%
}

.litepicker .container__footer .button-cancel {
    background-color: var(--litepicker-button-cancel-color-bg);
    color: var(--litepicker-button-cancel-color);
    border: 0;
    padding: 3px 7px 4px;
    border-radius: 3px
}

.litepicker .container__footer .button-cancel * {
    pointer-events: none
}

.litepicker .container__footer .button-apply {
    background-color: var(--litepicker-button-apply-color-bg);
    color: var(--litepicker-button-apply-color);
    border: 0;
    padding: 3px 7px 4px;
    border-radius: 3px;
    margin-left: 10px;
    margin-right: 10px
}

.litepicker .container__footer .button-apply:disabled {
    opacity: 0.7
}

.litepicker .container__footer .button-apply * {
    pointer-events: none
}

.litepicker .container__tooltip {
    position: absolute;
    margin-top: -4px;
    padding: 4px 8px;
    border-radius: 4px;
    background-color: var(--litepicker-tooltip-color-bg);
    -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
    white-space: nowrap;
    font-size: 11px;
    pointer-events: none;
    visibility: hidden
}

.litepicker .container__tooltip:before {
    position: absolute;
    bottom: -5px;
    left: calc(50% - 5px);
    border-top: 5px solid rgba(0, 0, 0, 0.12);
    border-right: 5px solid transparent;
    border-left: 5px solid transparent;
    content: ""
}

.litepicker .container__tooltip:after {
    position: absolute;
    bottom: -4px;
    left: calc(50% - 4px);
    border-top: 4px solid var(--litepicker-tooltip-color-bg);
    border-right: 4px solid transparent;
    border-left: 4px solid transparent;
    content: ""
}

/*range*/
.litepicker[data-plugins*="ranges"] > .container__main > .container__predefined-ranges {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  margin-top: 10px;
  margin-left: 10px;
  min-width: max-content;
  width: 100px;
}
.litepicker[data-plugins*="ranges"][data-ranges-position="left"] > .container__main {
  /* */
}
.litepicker[data-plugins*="ranges"][data-ranges-position="right"] > .container__main{
  flex-direction: row-reverse;
}

.litepicker[data-plugins*="ranges"][data-ranges-position="top"] > .container__main {
  flex-direction: column;
}
.litepicker[data-plugins*="ranges"][data-ranges-position="top"] > .container__main > .container__predefined-ranges {
  flex-direction: row;
}
.litepicker[data-plugins*="ranges"][data-ranges-position="bottom"] > .container__main {
  flex-direction: column-reverse;
}
.litepicker[data-plugins*="ranges"][data-ranges-position="bottom"] > .container__main > .container__predefined-ranges {
  flex-direction: row;
  box-shadow: 2px 0px 2px var(--litepicker-footer-box-shadow-color);
}
.litepicker[data-plugins*="ranges"] > .container__main > .container__predefined-ranges button {
  padding: 5px;
  margin: 2px 0;
}
.litepicker[data-plugins*="ranges"][data-ranges-position="left"] > .container__main > .container__predefined-ranges button,
.litepicker[data-plugins*="ranges"][data-ranges-position="right"] > .container__main > .container__predefined-ranges button{
  width: 100%;
  text-align: left;
}
.litepicker[data-plugins*="ranges"] > .container__main > .container__predefined-ranges button:hover {
  cursor: default;
  opacity: .6;
}

.container__predefined-ranges+.container__months {
  border-left: var(--tblr-border-width) var(--tblr-border-style) var(--tblr-border-color);
}
.container__main+.container__footer {
  border-top: var(--tblr-border-width) var(--tblr-border-style) var(--tblr-border-color);
}
    </style>
    <style>:root {
      --litepicker-mobilefriendly-backdrop-color-bg: #000;
    }
    
    .litepicker-backdrop {
      display: none;
      background-color: var(--litepicker-mobilefriendly-backdrop-color-bg);
      opacity: 0.3;
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
    }
    
    .litepicker-open {
      overflow: hidden;
    }
    
    .litepicker.mobilefriendly[data-plugins*="mobilefriendly"] {
      transform: translate(-50%, -50%);
      font-size: 110%;
      --litepicker-container-months-box-shadow-color: #616161;
    }
    .litepicker.mobilefriendly-portrait {
      /* --litepicker-day-width: 13.5vw; */
      --litepicker-month-width: calc(var(--litepicker-day-width) * 7);
    }
    .litepicker.mobilefriendly-landscape {
      --litepicker-day-width: 5.5vw;
      --litepicker-month-width: calc(var(--litepicker-day-width) * 7);
    }
    
    .litepicker[data-plugins*="mobilefriendly"] .container__months {
      overflow: hidden;
    }
    
    .litepicker.mobilefriendly[data-plugins*="mobilefriendly"] .container__months .month-item-header {
      height: var(--litepicker-day-width);
    }
    
    .litepicker.mobilefriendly[data-plugins*="mobilefriendly"] .container__days > div {
      height: var(--litepicker-day-width);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    
    .litepicker[data-plugins*="mobilefriendly"] .container__months .month-item {
      transform-origin: center;
    }
    
    .litepicker[data-plugins*="mobilefriendly"] .container__months .month-item.touch-target-next {
      animation-name: lp-bounce-target-next;
      animation-duration: .5s;
      animation-timing-function: ease;
    }
    
    .litepicker[data-plugins*="mobilefriendly"] .container__months .month-item.touch-target-prev {
      animation-name: lp-bounce-target-prev;
      animation-duration: .5s;
      animation-timing-function: ease;
    }
    
    @keyframes lp-bounce-target-next {
      from {
        transform: translateX(100px) scale(0.5);
      }
      to {
        transform: translateX(0px) scale(1);
      }
    }
    
    @keyframes lp-bounce-target-prev {
      from {
        transform: translateX(-100px) scale(0.5);
      }
      to {
        transform: translateX(0px) scale(1);
      }
    }
    </style>
