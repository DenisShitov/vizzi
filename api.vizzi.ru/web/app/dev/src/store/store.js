import axios from "axios";
import Vuex from "vuex";
import {version} from "@/../package.json";

const store = new Vuex.Store({
  state: {
    version: '',
    campsTest: [
      {
          id: 1,
          name: 'Семейный Campus 1170',
          rating: 5,
          address: 'Россия, Сочи, Приют Панды',
          ages: { from: 10, to: 17 },
          descript: 'Интерактивная программа изучения английского языка для детей 10 - 17 лет и отдых для родителей',
          transport: 'Автобус',
          meal: '3',
          newPrice: '62520',
          oldPrice: '69500',
          interval: '18',
          tags: ['Оздоровительный', 'Тематический', 'Языковой'],
          img: ['/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/gorod-dostizheniy-6464-289-39.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/dolzhemchuzhnyiy-bereg-421-pic.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/dolzhemchuzhnyiy-bereg-421-pic.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg']
      },
      {
          id: 2,
          name: 'ДОЛ "Спутник"',
          rating: 3.46,
          address: 'Россия, Таганрог, ДОК "Спутник"',
          ages: { from: 7, to: 17 },
          descript: 'Приглашаем всех задорных, веселых, активных, любознательных ребят в возрасте от 6 до 17 лет. Вас ждут комфортные условия проживания , 5-разовое здоровое питание, разнообразная программа досуга, уникальная парковая зона площадью 9 Га на первой линии от Азовского моря, большой спортивный комплекс, большой песчаный пляж 1000 кв. м, песчаное дно, экскурсионное обслуживание.',
          transport: 'Автобус',
          meal: '3',
          newPrice: '62500',
          oldPrice: '69500',
          interval: '18',
          tags: ['Оздоровительный', 'Тематический', 'Языковой', 'Танцевальный'],
          img: ['/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/gorod-dostizheniy-6464-289-39.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/dolzhemchuzhnyiy-bereg-421-pic.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/dolzhemchuzhnyiy-bereg-421-pic.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg']
      },
      {
          id: 3,
          name: 'Компьютерная Академия ТОР',
          rating: 1.52349,
          address: 'Россия, Ростов-на-Дону, ул. Социалистическая 141, оф. 410,411',
          ages: { from: 8, to: 15 },
          descript: 'В компьютерном лагере ваши дети пробуют себя в различных компьютерных специальностях. Под руководством опытных тренеров и преподавателей Компьютерной Академии ШАГ они реализуют свои самые смелые проекты. Детей ждут комфортные, специально оборудованные аудитории, конференц-залы и дизайн-студии. Вы подарите своему ребенку сказочный мир информационных технологий!',
          transport: 'Самоходом',
          meal: '0',
          newPrice: '62500',
          oldPrice: '69500',
          interval: '18',
          tags: ['Английский', 'IT и программирование', 'Творческий', 'Образовательный', 'Языковой'],
          img: ['/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/gorod-dostizheniy-6464-289-39.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/dolzhemchuzhnyiy-bereg-421-pic.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/dolzhemchuzhnyiy-bereg-421-pic.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg']
      },
      {
          id: 4,
          name: 'КлоДэ',
          rating: 2.2346,
          address: 'Россия, Таганрог, СОК "МИР"',
          ages: { from: 7, to: 17 },
          descript: 'Лагерь "КлоДэ" уже на протяжении 10 лет наполняет каникулы детей яркими впечатлениями и новыми знаниями! Наша база на Азовском море буквально создана для идеальных летних каникул! И вот почему: огромная территория лагеря с комфортными корпусами и современными спортивными площадками, дети купаются в море и бассейне каждый день, программа мероприятий, направленных на развитие физических и творческих способностей детей.',
          transport: 'ж/д, из Москвы, не входит в стоимость',
          meal: '2',
          newPrice: '62500',
          oldPrice: '69500',
          interval: '18',
          tags: ['Английский', 'Языковой'],
          img: ['/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/gorod-dostizheniy-6464-289-39.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/dolzhemchuzhnyiy-bereg-421-pic.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/dolzhemchuzhnyiy-bereg-421-pic.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg']
      },
      {
          id: 5,
          name: 'Эволюция',
          rating: 0.3765,
          address: 'Россия, Евпатория, Центр спорта "Эволюция"',
          ages: { from: 8, to: 16 },
          descript: '"Эволюция" - круглогодичный детский лагерь, где каждые каникулы ребят ждет новая программа, бассейн, спортивные игры, квесты и дискотеки. На сменах дети в игровой форме развивают в себе лидерские качества, коммуникативность, ловкость, внимание, творчество, смелость и положительные установки к миру.',
          transport: 'ж/д, из Москвы, не входит в стоимость',
          meal: '3',
          newPrice: '62500',
          oldPrice: '69500',
          interval: '18',
          tags: ['IT и программирование', 'Творческий', 'Образовательный'],
          img: ['/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/gorod-dostizheniy-6464-289-39.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/dolzhemchuzhnyiy-bereg-421-pic.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/dolzhemchuzhnyiy-bereg-421-pic.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg']
      },
      {
          id: 6,
          name: 'Крымские каникулы',
          rating: 4.99,
          address: 'Россия, Евпатория, Чайка',
          ages: { from: 8, to: 16 },
          descript: 'Этим летом на нашу развивающую программу "Крымские Каникулы" приглашаем вас в Евпаторию на базе детского санатория МДМЦ Чайка. Санаторий полностью соответствует российским стандартам безопасности детского отдыха, во всех номерах установлены кондиционеры, номера категории комфорт , 1 береговая линия. Территория (почти 42 га) – это прекрасная парковая зона, с тенистыми аллеями, фонтаном и цветниками. Этим летом мы погружаемся в Созвездие " Открытий и приключений" . Ежедневно в программе: творческие мастерские, квесты, интерактивные программы, экшн-игры, танцевальные баттлы, оздоровительные тонус программы, праздничные шоу и фестивали. Наши педагоги и аниматоры помогут развитию интеллектуальных способностей, повышению творческого потенциала, воображения, ловкости и силы, раскрытию талантов, зарядиться позитивом, найти новых друзей и набраться сил к новому учебному году.',
          transport: 'ж/д, из Москвы, не входит в стоимость',
          meal: '3',
          newPrice: '52000',
          oldPrice: '75000',
          interval: '18',
          tags: ['Английский', 'IT и программирование', 'Творческий', 'Образовательный', 'Языковой'],
          img: ['/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/gorod-dostizheniy-6464-289-39.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/dolzhemchuzhnyiy-bereg-421-pic.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/dolzhemchuzhnyiy-bereg-421-pic.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg']
      },
      {
          id: 7,
          name: 'Жемчужный берег',
          rating: 3.11111122,
          address: 'Россия, Евпатория, Чайка',
          ages: { from: 8, to: 16 },
          descript: 'Детский лагерь "Жемчужный берег" расположен в Крыму, на берегу Черного моря, в 12 км от Ялты в поселке Гурзуф. Гурзуф прекрасен в любое время года: необыкновенные крымские пейзажи, живописные бухты – привлекали к себе Пушкина, Чехова, Шаляпина. В Гурзуфе, у подножия горы Аю-Даг, расположен и знаменитый детский оздоровительный центр "Артек". Территория лагеря 1,3 гектара, расположена в парковой зоне из реликтовых хвойных деревьев. Путь на пляж (500 метров) лежит через старинный парк санатория "Гурзуфский", природа которого наполнена ароматами эфирных масел эвкалипта и можжевельника.',
          transport: 'Россия, Ялта/Гурзуф, Жемчужный Берег',
          meal: '2',
          newPrice: '60000',
          oldPrice: '77000',
          interval: '18',
          tags: ['Тематический', 'Танцевальный', 'Музыкальный'],
          img: ['/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/gorod-dostizheniy-6464-289-39.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/dolzhemchuzhnyiy-bereg-421-pic.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg', '/img/dolzhemchuzhnyiy-bereg-421-pic.jpg', '/img/kryimskie-kanikulyi-6178-890-pic.jpg']
      },
    ],
    camps: [],
    regions:[
      {
       "id": "1",
       "name": "Респ Адыгея"
      },
      {
        "id": "2",
        "name": "Респ Башкортостан"
       },
      {
       "id": "3",
       "name": "Респ Алтай"
      },
      {
       "id": "4",
       "name": "Алтайский край"
      },
      {
       "id": "5",
       "name": "Амурская обл"
      },
      {
       "id": "6",
       "name": "Архангельская обл"
      },
      {
       "id": "7",
       "name": "Астраханская обл"
      },
      {
       "id": "8",
       "name": "Респ Башкортостан"
      },
      {
       "id": "9",
       "name": "Белгородская обл"
      },
      {
       "id": "10",
       "name": "Брянская обл"
      },
      {
       "id": "11",
       "name": "Респ Бурятия"
      },
      {
       "id": "12",
       "name": "Респ Чеченская"
      },
      {
       "id": "13",
       "name": "Челябинская обл"
      },
      {
       "id": "15",
       "name": "Чукотский АО"
      },
      {
       "id": "16",
       "name": "Чувашская Республика - Чувашия"
      },
      {
       "id": "17",
       "name": "Респ Дагестан"
      },
      {
       "id": "19",
       "name": "Респ Ингушетия"
      },
      {
       "id": "20",
       "name": "Иркутская обл"
      },
      {
       "id": "21",
       "name": "Ивановская обл"
      },
      {
       "id": "22",
       "name": "Респ Кабардино-Балкарская"
      },
      {
       "id": "23",
       "name": "Калининградская обл"
      },
      {
       "id": "24",
       "name": "Респ Калмыкия"
      },
      {
       "id": "25",
       "name": "Калужская обл"
      },
      {
       "id": "27",
       "name": "Респ Карачаево-Черкесская"
      },
      {
       "id": "28",
       "name": "Респ Карелия"
      },
      {
       "id": "29",
       "name": "Кемеровская область - Кузбасс"
      },
      {
       "id": "30",
       "name": "Хабаровский край"
      },
      {
       "id": "31",
       "name": "Респ Хакасия"
      },
      {
       "id": "32",
       "name": "Ханты-Мансийский АО"
      },
      {
       "id": "33",
       "name": "Кировская обл"
      },
      {
       "id": "34",
       "name": "Респ Коми"
      },
      {
       "id": "37",
       "name": "Костромская обл"
      },
      {
       "id": "38",
       "name": "Краснодарский край"
      },
      {
       "id": "40",
       "name": "Курганская обл"
      },
      {
       "id": "41",
       "name": "Курская обл"
      },
      {
       "id": "42",
       "name": "Ленинградская обл"
      },
      {
       "id": "43",
       "name": "Липецкая обл"
      },
      {
       "id": "44",
       "name": "Магаданская обл"
      },
      {
       "id": "45",
       "name": "Респ Марий Эл"
      },
      {
       "id": "46",
       "name": "Респ Мордовия"
      },
      {
       "id": "47",
       "name": "Московская обл"
      },
      {
       "id": "48",
       "name": "г Москва"
      },
      {
       "id": "49",
       "name": "Мурманская обл"
      },
      {
       "id": "50",
       "name": "Ненецкий АО"
      },
      {
       "id": "51",
       "name": "Нижегородская обл"
      },
      {
       "id": "52",
       "name": "Новгородская обл"
      },
      {
       "id": "53",
       "name": "Новосибирская обл"
      },
      {
       "id": "54",
       "name": "Омская обл"
      },
      {
       "id": "55",
       "name": "Оренбургская обл"
      },
      {
       "id": "56",
       "name": "Орловская обл"
      },
      {
       "id": "57",
       "name": "Пензенская обл"
      },
      {
       "id": "59",
       "name": "Приморский край"
      },
      {
       "id": "60",
       "name": "Псковская обл"
      },
      {
       "id": "61",
       "name": "Ростовская обл"
      },
      {
       "id": "62",
       "name": "Рязанская обл"
      },
      {
       "id": "63",
       "name": "Респ Саха Якутия"
      },
      {
       "id": "64",
       "name": "Сахалинская обл"
      },
      {
       "id": "65",
       "name": "Самарская обл"
      },
      {
       "id": "66",
       "name": "г Санкт-Петербург"
      },
      {
       "id": "67",
       "name": "Саратовская обл"
      },
      {
       "id": "68",
       "name": "Респ Северная Осетия - Алания"
      },
      {
       "id": "69",
       "name": "Смоленская обл"
      },
      {
       "id": "70",
       "name": "Ставропольский край"
      },
      {
       "id": "71",
       "name": "Свердловская обл"
      },
      {
       "id": "72",
       "name": "Тамбовская обл"
      },
      {
       "id": "73",
       "name": "Респ Татарстан"
      },
      {
       "id": "75",
       "name": "Томская обл"
      },
      {
       "id": "76",
       "name": "Тульская обл"
      },
      {
       "id": "77",
       "name": "Тверская обл"
      },
      {
       "id": "78",
       "name": "Тюменская обл"
      },
      {
       "id": "79",
       "name": "Респ Тыва"
      },
      {
       "id": "80",
       "name": "Респ Удмуртская"
      },
      {
       "id": "81",
       "name": "Ульяновская обл"
      },
      {
       "id": "83",
       "name": "Владимирская обл"
      },
      {
       "id": "84",
       "name": "Волгоградская обл"
      },
      {
       "id": "85",
       "name": "Вологодская обл"
      },
      {
       "id": "86",
       "name": "Воронежская обл"
      },
      {
       "id": "87",
       "name": "Ямало-Ненецкий АО"
      },
      {
       "id": "88",
       "name": "Ярославская обл"
      },
      {
       "id": "89",
       "name": "Еврейская Аобл"
      },
      {
       "id": "90",
       "name": "Пермский край"
      },
      {
       "id": "91",
       "name": "Красноярский край"
      },
      {
       "id": "92",
       "name": "Камчатский край"
      },
      {
       "id": "93",
       "name": "Забайкальский край"
      },
      {
       "id": "94",
       "name": "Респ Крым"
      },
      {
       "id": "95",
       "name": "г Севастополь"
      }
    ],
    filter: {
      name: '',
      regions: [],
      transport: [],
      ages: [],
      category: [],
      tagName: '',
      season: [],
      accomodation: []
    }
  },
  getters: {
    CAMPS(state) {
      return state.camps;
    },
    REGIONS(state) {
      return state.regions;
    },
    // FILTER(state) {
    //   return state.filter;
    // }
  },
  mutations: {
    initialiseStore(state) {
      if(localStorage.getItem('store')) {
        let store = JSON.parse(localStorage.getItem('store'));
        if(store.version == version) {
          this.replaceState(
            Object.assign(state, store)
          );
        } else {
          state.version = version;
        }
      }
    },
    TYPE_NAME(state, name) {
      state.filter.name = name;
    },
    SELECT_REGION(state, regNum) {
      state.filter.regions = regNum;
    },
    SELECT_TRANSPORT(state, transp) {
      state.filter.transport = transp;
    },
    SELECT_CATEGORY(state, cat) {
      state.filter.category = cat;
    },
    SELECT_AGE(state, age) {
      state.filter.ages = age;
    },
    GET_CAMPS(state, camps) {
      state.camps = camps;
    },
    FILTER_CAMPS_BY_NAME(state, name) {
      if (name != '') {
        axios({
          method: 'get',
          url: `http://vh526442.eurodir.ru/api/camps?filter[c_name][like]=${name}`
        })
        .then((req) => {
          state.camps = req.data;
        })
      } else {
        axios({
          method: 'get',
          url: 'http://vh526442.eurodir.ru/api/camps?'
        })
        .then((req) => {
          state.camps = req.data;
        })
      }
    },
    FILTER_CAMPS_BY_TAG(state, tag) {
      if (tag != '') {
        axios({
          method: 'get',
          url: `http://vh526442.eurodir.ru/api/camps?filter[c_tags][like]=${tag}`
        })
        .then((req) => {
          state.camps = req.data;
        })
      }
    },
    FILTER_CAMPS_BY_CHECKBOX(state) {
      state.camps = [];
      let filter = state.filter;
      let url = '?';

      // FILTER BY REGIONS
      // if (filter.regions.length > 1) {
      //   filter.regions.forEach(element => {
      //     let str = 'filter[c_location][in][]=';
      //     str = str + element + '&';
      //     url = url + str;
      //   });
      // } else if (filter.regions.length === 1) {
      //   let str = 'filter[c_location]=';
      //   str = str + Object.values(filter.regions);
      //   url = url + str;
      // } 

      //FILTER BY TRANSPORT
      if (filter.transport.length > 1) {
        filter.transport.forEach(element => {
          let str = 'filter[c_transfer][in][]=';
          str = str + element + '&';
          url += str;
        });
      } else if (filter.transport.length === 1) {
        let str = 'filter[c_transfer]=';
        str = str + Object.values(filter.transport) + '&';
        url += str;
      }

      //FILTER BY CATEGORY
      if (filter.category.length > 1) {
        filter.category.forEach(element => {
          let str = 'filter[c_category][in][]=';
          str = str + element + '&';
          url += str;
        });
      } else if (filter.category.length === 1) {
        let str = 'filter[c_category]=';
        str = str + Object.values(filter.category) + '&';
        url += str;
      }
      
      axios({
        method: 'get',
        url: `http://vh526442.eurodir.ru/api/camps${url}`
      })
      .then((req) => {
        state.camps = req.data;
        //Фильтрация по возрасту(пока фильтруется массив из стора, не с сервера)
        if (filter.ages.length >= 1) {
          let min = Math.min(...filter.ages);
          let max = Math.max(...filter.ages);
          console.log(min, max);
          let arr = state.camps.filter(camp => {return camp.c_age_from <= min && max <= camp.c_age_to});
          console.log(arr);
          state.camps = arr;  
        };
      });
      
      
    },
    FILTER_RESET(state) {
      state.camps = [];
      axios({
        method: 'get',
        url: 'http://vh526442.eurodir.ru/api/camps'
      })
      .then((req) => {
        state.camps = req.data;
      });
      state.filter.name = '';
      state.filter.regions = [];
      state.filter.transport = [];
      state.filter.ages = [];
      state.filter.category = [];
    }
  },
  actions: {
    typeName({commit}, name) {
      commit('TYPE_NAME', name)
    },
    selectRegion({commit}, regNum) {
      commit('SELECT_REGION', regNum)
    },
    selectTransport({commit}, transp) {
      commit('SELECT_TRANSPORT', transp)
    },
    selectCategory({commit}, cat) {
      commit('SELECT_CATEGORY', cat)
    },
    selectAge({commit}, age) {
      commit('SELECT_AGE', age)
    }
  },
  // plugins: [dataState]
});

store.subscribe((mutation, state) => {
	localStorage.setItem('store', JSON.stringify(state.filter));
});

export default store;